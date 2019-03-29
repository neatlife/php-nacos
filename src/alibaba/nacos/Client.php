<?php


namespace alibaba\nacos;


use alibaba\nacos\failover\LocalConfigInfoProcessor;
use alibaba\nacos\request\config\DeleteConfigsConfigRequest;
use alibaba\nacos\request\config\GetConfigsConfigRequest;
use alibaba\nacos\request\config\ListenerConfigRequest;
use alibaba\nacos\request\config\PublishConfigsConfigRequest;
use alibaba\nacos\util\LogUtil;

/**
 * Class Client
 * @author suxiaolin
 * @package alibaba\nacos
 */
class Client
{
    public static function get($env, $dataId, $group, $tenant)
    {
        $getConfigsConfigRequest = new GetConfigsConfigRequest();
        $getConfigsConfigRequest->setDataId($dataId);
        $getConfigsConfigRequest->setGroup($group);

        try {
            $response = $getConfigsConfigRequest->doRequest();
            $config = $response->getBody()->getContents();
            LocalConfigInfoProcessor::saveSnapshot($env, $dataId, $group, $tenant, $config);
        } catch (\Exception $e) {
            LogUtil::error("拉去服务器配置异常，开始从本地获取配置, message: " . $e->getMessage());
            $config = LocalConfigInfoProcessor::getFailover($env, $dataId, $group, $tenant);
            $config = $config ? $config
                : LocalConfigInfoProcessor::getSnapshot($env, $dataId, $group, $tenant);
        }

        return $config;
    }

    /**
     * @param $dataId
     * @param $group
     * @param $tenant
     * @return bool true 删除成功
     * @throws \ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public static function delete($dataId, $group, $tenant)
    {
        $deleteConfigsConfigRequest = new DeleteConfigsConfigRequest();
        $deleteConfigsConfigRequest->setDataId($dataId);
        $deleteConfigsConfigRequest->setGroup($group);
        $deleteConfigsConfigRequest->setTenant($tenant);

        $response = $deleteConfigsConfigRequest->doRequest();
        return $response->getBody()->getContents() == "true";
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
        $publishConfigsConfigRequest = new PublishConfigsConfigRequest();
        $publishConfigsConfigRequest->setDataId($dataId);
        $publishConfigsConfigRequest->setGroup($group);
        $publishConfigsConfigRequest->setTenant($tenant);
        $publishConfigsConfigRequest->setContent($content);

        try {
            $response = $publishConfigsConfigRequest->doRequest();
        } catch (\Exception $e) {
            return false;
        }
        return $response->getBody()->getContents() == "true";
    }

    public static function listener($env, $dataId, $group, $config, $tenant = "")
    {
        $loop = 0;
        do {
            $loop ++;

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
            } catch (\Exception $e) {
                LogUtil::error("listener请求异常, e: " . $e->getMessage());
                // 短暂休息会儿
                usleep(500);
            }
            LogUtil::info("listener loop count: " . $loop);
        } while (true);
    }
}