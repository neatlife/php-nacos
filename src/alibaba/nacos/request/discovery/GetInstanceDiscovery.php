<?php

namespace alibaba\nacos\request\discovery;

class GetInstanceDiscovery extends DiscoveryRequest
{
    protected $uri = "/nacos/v1/ns/instance";
    protected $verb = "GET";

    /**
     * 服务名
     *
     * @var
     */
    private $serviceName;

    /**
     * 服务实例IP
     *
     * @var
     */
    private $ip;

    /**
     * 服务实例port
     *
     * @var
     */
    private $port;

    /**
     * 命名空间ID
     *
     * @var
     */
    private $namespaceId;

    /**
     * 集群名称
     * @var
     */
    private $cluster;

    /**
     * 是否只返回健康实例
     *
     * @var
     */
    private $healthyOnly = false;

    /**
     * @return mixed
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @param mixed $serviceName
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getNamespaceId()
    {
        return $this->namespaceId;
    }

    /**
     * @param mixed $namespaceId
     */
    public function setNamespaceId($namespaceId)
    {
        $this->namespaceId = $namespaceId;
    }

    /**
     * @return mixed
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * @param mixed $cluster
     */
    public function setCluster($cluster)
    {
        $this->cluster = $cluster;
    }

    /**
     * @return mixed
     */
    public function getHealthyOnly()
    {
        return $this->healthyOnly;
    }

    /**
     * @param mixed $healthyOnly
     */
    public function setHealthyOnly($healthyOnly)
    {
        $this->healthyOnly = $healthyOnly;
    }
}
