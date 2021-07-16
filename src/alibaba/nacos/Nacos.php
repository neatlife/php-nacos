<?php


namespace alibaba\nacos;


use alibaba\nacos\util\LogUtil;

/**
 * Class Nacos
 *
 * @author suxiaolin
 * @package alibaba\nacos
 */
class Nacos
{
    private static $clientClass;

    public static function init($host, $env, $dataId, $group, $tenant)
    {
        static $client;
        if ($client == null) {
            NacosConfig::setHost($host);
            NacosConfig::setEnv($env);
            NacosConfig::setDataId($dataId);
            NacosConfig::setGroup($group);
            NacosConfig::setTenant($tenant);

            if (getenv("NACOS_ENV") == "local") {
                LogUtil::info("nacos run in dummy mode");
                self::$clientClass = DummyNacosClient::class;
            } else {
                self::$clientClass = NacosClient::class;
            }

            $client = new self();
        }

        return $client;
    }

    public function runOnce()
    {
        return call_user_func_array([self::$clientClass, "get"], [NacosConfig::getEnv(), NacosConfig::getDataId(), NacosConfig::getGroup(), NacosConfig::getTenant()]);
    }

    public function listener()
    {
        call_user_func_array([self::$clientClass, "listener"], [NacosConfig::getEnv(), NacosConfig::getDataId(), NacosConfig::getGroup(), '', NacosConfig::getTenant()]);

        return $this;
    }

}