<?php


namespace alibaba\nacos;


use ReflectionException;
use alibaba\nacos\model\Instance;

/**
 * Class Naming
 * @package alibaba\nacos
 */
class Naming
{
    /**
     * @param $serviceName
     * @param $ip
     * @param $port
     * @param string $namespaceId
     * @param string $weight
     * @return Naming
     */
    public static function init($serviceName, $ip, $port, $namespaceId = "", $weight = "", $ephemeral = true)
    {
        static $client;
        if ($client == null) {
            NamingConfig::setServiceName($serviceName);
            NamingConfig::setIp($ip);
            NamingConfig::setPort($port);
            NamingConfig::setNamespaceId($namespaceId);
            NamingConfig::setWeight($weight);
            NamingConfig::setEphemeral($ephemeral);

            $client = new self();
        }
        return $client;
    }

    /**
     * @param bool $enable
     * @param bool $healthy
     * @param string $clusterName
     * @param string $metadata
     * @return bool
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function register($enable = true, $healthy = true, $clusterName = "", $metadata = "{}")
    {
        return NamingClient::register(
            NamingConfig::getServiceName(),
            NamingConfig::getIp(),
            NamingConfig::getPort(),
            NamingConfig::getWeight(),
            NamingConfig::getNamespaceId(),
            $enable,
            $healthy,
            $clusterName,
            $metadata
        );
    }

    /**
     * @param $serviceName
     * @param $ip
     * @param $port
     * @param string $namespaceId
     * @param string $clusterName
     * @return bool
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function delete($namespaceId = "", $clusterName = "")
    {
        return NamingClient::delete(
            NamingConfig::getServiceName(),
            NamingConfig::getIp(),
            NamingConfig::getPort(),
            $namespaceId,
            $clusterName
        );
    }

    /**
     * @param string $weight
     * @param string $namespaceId
     * @param string $clusterName
     * @param string $metadata
     * @return bool
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function update($weight = "", $namespaceId = "", $clusterName = "", $metadata = "{}")
    {
        return NamingClient::update(
            NamingConfig::getServiceName(),
            NamingConfig::getIp(),
            NamingConfig::getPort(),
            $weight,
            $namespaceId,
            $clusterName,
            $metadata
        );
    }

    /**
     * @param bool $healthyOnly
     * @param string $namespaceId
     * @param string $clusters
     * @return model\InstanceList
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function listInstances($healthyOnly = false, $namespaceId = "", $clusters = "")
    {
        return NamingClient::listInstances(
            NamingConfig::getServiceName(),
            $healthyOnly,
            $namespaceId,
            $clusters
        );
    }

    /**
     * @param bool $healthyOnly
     * @param string $weight
     * @param string $namespaceId
     * @param string $clusters
     * @return model\Instance
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function get($healthyOnly = false, $weight = "", $namespaceId = "", $clusters = "")
    {
        return NamingClient::get(
            NamingConfig::getServiceName(),
            NamingConfig::getIp(),
            NamingConfig::getPort(),
            $healthyOnly,
            $weight,
            $namespaceId,
            $clusters
        );
    }

    /**
     * @param Instance $instance
     * @return model\Beat
     * @throws ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function beat(Instance $instance = null)
    {
        if ($instance == null) {
            $instance = $this->get();
        }
        return NamingClient::beat(
            NamingConfig::getServiceName(),
            $instance->encode()
        );
    }

}