<?php


namespace alibaba\nacos\util;

/**
 * Class DiscoveryUtil
 * @package alibaba\nacos\util
 */
class DiscoveryUtil
{
    /**
     * @param $ip
     * @param $port
     * @param $serviceName
     * @param string $cluster
     * @return string
     */
    public static function getInstanceId($ip, $port, $serviceName, $cluster = "")
    {
        if (!$cluster) {
            $cluster = "DEFAULT";
        }
        return sprintf("%s#%s#%s#%s", $ip, $port, $cluster, $serviceName);
    }

    /**
     * @param $serviceName
     * @param string $namespaceId
     * @param string $clusters
     * @return string
     */
    public static function getInstanceListId($serviceName, $namespaceId = "", $clusters = "")
    {
        if (!$clusters) {
            $clusters = "DEFAULT";
        }
        return sprintf("%s#%s#%s", $serviceName, $namespaceId, $clusters);
    }
}