<?php


namespace alibaba\nacos\failover;


use alibaba\nacos\model\Instance;
use alibaba\nacos\NacosConfig;
use alibaba\nacos\util\DiscoveryUtil;
use SplFileInfo;

/**
 * Class LocalDiscoveryInfoProcessor
 * @package alibaba\nacos\failover
 */
class LocalDiscoveryInfoProcessor extends Processor
{
    const DS = DIRECTORY_SEPARATOR;

    public static function getFailover($serviceName, $ip, $port, $cluster)
    {
        $failoverFile = self::getFailoverFile($serviceName, $ip, $port, $cluster);
        if (!is_file($failoverFile)) {
            return null;
        }
        return Instance::decode(file_get_contents($failoverFile));
    }

    public static function getFailoverFile($serviceName, $ip, $port, $cluster)
    {
        $failoverFile = NacosConfig::getSnapshotPath() . self::DS . "naming-data"
            . self::DS . DiscoveryUtil::getInstanceId($serviceName, $ip, $port, $cluster);
        return $failoverFile;
    }

    /**
     * 获取本地缓存文件内容。NULL表示没有本地文件或抛出异常。
     */
    public static function getSnapshot($name, $dataId, $group, $tenant)
    {
        $snapshotFile = self::getSnapshotFile($name, $dataId, $group, $tenant);
        if (!is_file($snapshotFile)) {
            return null;
        }
        return Instance::decode(file_get_contents($snapshotFile));
    }

    public static function getSnapshotFile($serviceName, $ip, $port, $cluster)
    {
        $snapshotFile = NacosConfig::getSnapshotPath() . self::DS . "naming-data-snapshot"
            . self::DS . DiscoveryUtil::getInstanceId($serviceName, $ip, $port, $cluster);
        return $snapshotFile;
    }

    /**
     * @param $serviceName
     * @param $ip
     * @param $port
     * @param $cluster
     * @param $instance Instance
     */
    public static function saveSnapshot($serviceName, $ip, $port, $cluster, $instance)
    {
        $snapshotFile = self::getSnapshotFile($serviceName, $ip, $port, $cluster);
        if (!$instance) {
            unlink($snapshotFile);
        } else {
            $file = new SplFileInfo($snapshotFile);
            if (!is_dir($file->getPath())) {
                mkdir($file->getPath(), 0777, true);
            }
            file_put_contents($snapshotFile, $instance->encode());
        }
    }

}