<?php

namespace alibaba\nacos;

use Monolog\Logger;

/**
 * Class NacosConfig
 * @author suxiaolin
 * @package alibaba\nacos
 */
class NacosConfig
{
    /**
     * @var string 项目名
     */
    private static $name = "nacos-client";

    /**
     * @var string 环境
     */
    private static $env = "dev";

    /**
     * 租户信息，对应 Nacos 的命名空间字段。
     * @var
     */
    private static $tenant;

    /**
     * 配置 ID
     * @var
     */
    private static $dataId;

    /**
     * 配置分组。
     * @var
     */
    private static $group;

    /**
     * @var string 快照文件存放目录
     */
    private static $snapshotPath = "nacos/config";

    /**
     * @var int 长轮询等待时间, 默认30秒
     */
    private static $longPullingTimeout = 30000;

    /**
     * 日志保存路径
     *
     * @var string
     */
    private static $logPath = "php://stdout";

    /**
     * 日志级别
     *
     * @var int
     */
    private static $logLevel = Logger::INFO;

    /**
     * nacos服务器地址
     *
     * @var
     */
    private static $host;

    /**
     * 是否调试模式
     *
     * @var
     */
    private static $isDebug = false;

    /**
     * @return string
     */
    public static function getName()
    {
        return self::$name;
    }

    /**
     * @return string
     */
    public static function getEnv()
    {
        return self::$env;
    }

    /**
     * @param string $env
     */
    public static function setEnv($env)
    {
        self::$env = $env;
    }

    /**
     * @return mixed
     */
    public static function getTenant()
    {
        return self::$tenant;
    }

    /**
     * @param mixed $tenant
     */
    public static function setTenant($tenant)
    {
        self::$tenant = $tenant;
    }

    /**
     * @return mixed
     */
    public static function getDataId()
    {
        return self::$dataId;
    }

    /**
     * @param mixed $dataId
     */
    public static function setDataId($dataId)
    {
        self::$dataId = $dataId;
    }

    /**
     * @return mixed
     */
    public static function getGroup()
    {
        return self::$group;
    }

    /**
     * @param mixed $group
     */
    public static function setGroup($group)
    {
        self::$group = $group;
    }

    /**
     * @return int
     */
    public static function getLongPullingTimeout()
    {
        return self::$longPullingTimeout;
    }

    /**
     * @param int $longPullingTimeout
     */
    public static function setLongPullingTimeout($longPullingTimeout)
    {
        self::$longPullingTimeout = $longPullingTimeout;
    }

    /**
     * @return string
     */
    public static function getSnapshotPath()
    {
        return self::$snapshotPath;
    }

    /**
     * @param string $snapshotPath
     */
    public static function setSnapshotPath($snapshotPath)
    {
        self::$snapshotPath = $snapshotPath;
    }

    /**
     * @return string
     */
    public static function getLogPath()
    {
        return self::$logPath;
    }

    /**
     * @param string $logPath
     */
    public static function setLogPath($logPath)
    {
        self::$logPath = $logPath;
    }

    /**
     * @return int
     */
    public static function getLogLevel()
    {
        return self::$logLevel;
    }

    /**
     * @param int $logLevel
     */
    public static function setLogLevel($logLevel)
    {
        self::$logLevel = $logLevel;
    }

    /**
     * @return mixed
     */
    public static function getHost()
    {
        return self::$host;
    }

    /**
     * @param mixed $host
     */
    public static function setHost($host)
    {
        self::$host = $host;
    }

    /**
     * @return mixed
     */
    public static function getIsDebug()
    {
        return self::$isDebug;
    }

    /**
     * @param mixed $isDebug
     */
    public static function setIsDebug($isDebug)
    {
        self::$isDebug = $isDebug;
    }
}