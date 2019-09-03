<?php


namespace alibaba\nacos\failover;


use SplFileInfo;
use alibaba\nacos\NacosConfig;

/**
 * Class LocalConfigInfoProcessor
 * @author suxiaolin
 * @package alibaba\nacos\failover
 */
class LocalConfigInfoProcessor extends Processor
{
    const DS = DIRECTORY_SEPARATOR;

    public static function getFailover($serverName, $dataId, $group, $tenant)
    {
        $failoverFile = self::getFailoverFile($serverName, $dataId, $group, $tenant);
        if (!is_file($failoverFile)) {
            return null;
        }
        return file_get_contents($failoverFile);
    }

    public static function getFailoverFile($serverName, $dataId, $group, $tenant)
    {
        $failoverFile = NacosConfig::getSnapshotPath() . self::DS . $serverName . "_nacos" . self::DS;
        if ($tenant) {
            $failoverFile .= "config-data-tenant" . self::DS . $tenant . self::DS;
        } else {
            $failoverFile .= "config-data" . self::DS;
        }
        return $failoverFile . $dataId;
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
        return file_get_contents($snapshotFile);
    }

    public static function getSnapshotFile($envName, $dataId, $group, $tenant)
    {
        $snapshotFile = NacosConfig::getSnapshotPath() . self::DS . $envName . "_nacos" . self::DS;
        if ($tenant) {
            $snapshotFile .= "snapshot-tenant" . self::DS . $tenant . self::DS;
        } else {
            $snapshotFile .= "snapshot" . self::DS;
        }
        return $snapshotFile .= $dataId;
    }

    public static function saveSnapshot($envName, $dataId, $group, $tenant, $config)
    {
        $snapshotFile = self::getSnapshotFile($envName, $dataId, $group, $tenant);
        if (!$config) {
            @unlink($snapshotFile);
        } else {
            $file = new SplFileInfo($snapshotFile);
            if (!is_dir($file->getPath())) {
                mkdir($file->getPath(), 0777, true);
            }
            file_put_contents($snapshotFile, $config);
        }
    }

}
