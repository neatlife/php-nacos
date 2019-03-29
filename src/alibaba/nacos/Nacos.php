<?php


namespace alibaba\nacos;


/**
 * Class Nacos
 * @author suxiaolin
 * @package alibaba\nacos
 */
class Nacos
{
    public static function init($host, $env, $dataId, $group, $tenant)
    {
        static $client;
        if ($client == null) {
            NacosConfig::setHost($host);
            NacosConfig::setEnv($env);
            NacosConfig::setDataId($dataId);
            NacosConfig::setGroup($group);
            NacosConfig::setTenant($tenant);

            $client = new self();
        }
        return $client;
    }

    public function runOnce()
    {
        Client::get(NacosConfig::getEnv(), NacosConfig::getDataId(), NacosConfig::getGroup(), NacosConfig::getTenant());
        return $this;
    }

    public function listener()
    {
        Client::listener(NacosConfig::getEnv(), NacosConfig::getDataId(), NacosConfig::getGroup(), NacosConfig::getTenant());
        return $this;
    }

}