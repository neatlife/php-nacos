<?php

namespace alibaba\nacos;

/**
 * Class NamingConfig
 * @package alibaba\nacos
 */
class NamingConfig extends NacosConfig
{
    /**
     * 服务名
     *
     * @var
     */
    private static $serviceName;

    /**
     * 服务实例IP
     *
     * @var
     */
    private static $ip;

    /**
     * 服务实例port
     *
     * @var
     */
    private static $port;

    /**
     * 命名空间ID
     *
     * @var
     */
    private static $namespaceId = "";

    /**
     * 权重
     *
     * @var
     */
    private static $weight = "";

    /**
     * @return mixed
     */
    public static function getServiceName()
    {
        return self::$serviceName;
    }

    /**
     * @param mixed $serviceName
     */
    public static function setServiceName($serviceName)
    {
        self::$serviceName = $serviceName;
    }

    /**
     * @return mixed
     */
    public static function getIp()
    {
        return self::$ip;
    }

    /**
     * @param mixed $ip
     */
    public static function setIp($ip)
    {
        self::$ip = $ip;
    }

    /**
     * @return mixed
     */
    public static function getPort()
    {
        return self::$port;
    }

    /**
     * @param mixed $port
     */
    public static function setPort($port)
    {
        self::$port = $port;
    }

    /**
     * @return mixed
     */
    public static function getNamespaceId()
    {
        return self::$namespaceId;
    }

    /**
     * @param mixed $namespaceId
     */
    public static function setNamespaceId($namespaceId)
    {
        self::$namespaceId = $namespaceId;
    }

    /**
     * @return mixed
     */
    public static function getWeight()
    {
        return self::$weight;
    }

    /**
     * @param mixed $weight
     */
    public static function setWeight($weight)
    {
        self::$weight = $weight;
    }

}