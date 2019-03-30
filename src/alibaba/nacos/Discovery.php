<?php


namespace alibaba\nacos;


use alibaba\nacos\model\Instance;

/**
 * Class Discovery
 * @package alibaba\nacos
 */
class Discovery
{
    /**
     * @param $serviceName
     * @param $ip
     * @param $port
     * @param string $namespaceId
     * @param string $weight
     * @return Discovery
     */
    public static function init($serviceName, $ip, $port, $namespaceId = "", $weight = "")
    {
        static $client;
        if ($client == null) {
            DiscoveryConfig::setServiceName($serviceName);
            DiscoveryConfig::setIp($ip);
            DiscoveryConfig::setPort($port);
            DiscoveryConfig::setNamespaceId($namespaceId);
            DiscoveryConfig::setWeight($weight);

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
     * @throws \ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function register($enable = true, $healthy = true, $clusterName = "", $metadata = "{}")
    {
        return DiscoveryClient::register(
            DiscoveryConfig::getServiceName(),
            DiscoveryConfig::getIp(),
            DiscoveryConfig::getPort(),
            DiscoveryConfig::getWeight(),
            DiscoveryConfig::getNamespaceId(),
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
     * @throws \ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function delete($namespaceId = "", $clusterName = "")
    {
        return DiscoveryClient::delete(
            DiscoveryConfig::getServiceName(),
            DiscoveryConfig::getIp(),
            DiscoveryConfig::getPort(),
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
     * @throws \ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function update($weight = "", $namespaceId = "", $clusterName = "", $metadata = "{}")
    {
        return DiscoveryClient::update(
            DiscoveryConfig::getServiceName(),
            DiscoveryConfig::getIp(),
            DiscoveryConfig::getPort(),
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
     * @throws \ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function listInstances($healthyOnly = false, $namespaceId = "", $clusters = "")
    {
        return DiscoveryClient::listInstances(
            DiscoveryConfig::getServiceName(),
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
     * @throws \ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function get($healthyOnly = false, $weight = "", $namespaceId = "", $clusters = "")
    {
        return DiscoveryClient::get(
            DiscoveryConfig::getServiceName(),
            DiscoveryConfig::getIp(),
            DiscoveryConfig::getPort(),
            $healthyOnly,
            $weight,
            $namespaceId,
            $clusters
        );
    }

    /**
     * @param Instance $instance
     * @return model\Beat
     * @throws \ReflectionException
     * @throws exception\RequestUriRequiredException
     * @throws exception\RequestVerbRequiredException
     * @throws exception\ResponseCodeErrorException
     */
    public function beat(Instance $instance = null)
    {
        if ($instance == null) {
            $instance = $this->get();
        }
        return DiscoveryClient::beat(
            DiscoveryConfig::getServiceName(),
            $instance->encode()
        );
    }

}