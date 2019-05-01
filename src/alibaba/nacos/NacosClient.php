<?php


namespace alibaba\nacos;


use Exception;
use ReflectionException;
use alibaba\nacos\util\LogUtil;
use alibaba\nacos\listener\config\Config;
use alibaba\nacos\request\config\GetConfigRequest;
use alibaba\nacos\failover\LocalConfigInfoProcessor;
use alibaba\nacos\request\config\DeleteConfigRequest;
use alibaba\nacos\request\config\PublishConfigRequest;
use alibaba\nacos\exception\ResponseCodeErrorException;
use alibaba\nacos\request\config\ListenerConfigRequest;
use alibaba\nacos\exception\RequestUriRequiredException;
use alibaba\nacos\exception\RequestVerbRequiredException;
use alibaba\nacos\listener\config\GetConfigRequestErrorListener;
use alibaba\nacos\listener\config\ListenerConfigRequestErrorListener;

/**
 * Class NacosClient
 * @author suxiaolin
 * @package alibaba\nacos
 */
class NacosClient
{
    /**
     * @param $env
     * @param $dataId
     * @param $group
     * @param $tenant
     * @return false|string|null
     */
    public static function get($env, $dataId, $group, $tenant)
    {
        $getConfigRequest = new GetConfigRequest();
        $getConfigRequest->setDataId($dataId);
        $getConfigRequest->setGroup($group);

        try {
            $response = $getConfigRequest->doRequest();
            $config = $response->getBody()->getContents();
            LocalConfigInfoProcessor::saveSnapshot($env, $dataId, $group, $tenant, $config);
        } catch (Exception $e) {
            LogUtil::error("获取配置异常，开始从本地获取配置, message: " . $e->getMessage());
            $config = LocalConfigInfoProcessor::getFailover($env, $dataId, $group, $tenant);
            $config = $config ? $config
                : LocalConfigInfoProcessor::getSnapshot($env, $dataId, $group, $tenant);
            $configListenerParameter = Config::of($env, $dataId, $group, $tenant, $config);
            GetConfigRequestErrorListener::notify($configListenerParameter);
            if ($configListenerParameter->isChanged()) {
                $config = $configListenerParameter->getConfig();
            }
        }

        return $config;
    }

    /**
     * @param $env
     * @param $dataId
     * @param $group
     * @param $config
     * @param string $tenant
     */
    public static function listener($env, $dataId, $group, $config, $tenant = "")
    {
        $loop = 0;
        do {
            $loop++;

            $listenerConfigRequest = new ListenerConfigRequest();
            $listenerConfigRequest->setDataId($dataId);
            $listenerConfigRequest->setGroup($group);
            $listenerConfigRequest->setTenant($tenant);
            $listenerConfigRequest->setContentMD5(md5($config));

            try {
                $response = $listenerConfigRequest->doRequest();
                if ($response->getBody()->getContents()) {
                    // 配置发生了变化
                    $config = self::get($env, $dataId, $group, $tenant);

                    LogUtil::info("found changed config: " . $config);

                    // 保存最新的配置
                    LocalConfigInfoProcessor::saveSnapshot($env, $dataId, $group, $tenant, $config);
                }
            } catch (Exception $e) {
                LogUtil::error("listener请求异常, e: " . $e->getMessage());
                ListenerConfigRequestErrorListener::notify($env, $dataId, $group, $tenant);
                // 短暂休息会儿
                usleep(500);
            }
            LogUtil::info("listener loop count: " . $loop);
        } while (true);
    }

    /**
     * @param $dataId
     * @param $group
     * @param $content
     * @param string $tenant
     * @return bool
     */
    public static function publish($dataId, $group, $content, $tenant = "")
    {
        $publishConfigRequest = new PublishConfigRequest();
        $publishConfigRequest->setDataId($dataId);
        $publishConfigRequest->setGroup($group);
        $publishConfigRequest->setTenant($tenant);
        $publishConfigRequest->setContent($content);

        try {
            $response = $publishConfigRequest->doRequest();
        } catch (Exception $e) {
            return false;
        }
        return $response->getBody()->getContents() == "true";
    }

    /**
     * @param $dataId
     * @param $group
     * @param $tenant
     * @return bool true 删除成功
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public static function delete($dataId, $group, $tenant)
    {
        $deleteConfigRequest = new DeleteConfigRequest();
        $deleteConfigRequest->setDataId($dataId);
        $deleteConfigRequest->setGroup($group);
        $deleteConfigRequest->setTenant($tenant);

        $response = $deleteConfigRequest->doRequest();
        return $response->getBody()->getContents() == "true";
    }
}