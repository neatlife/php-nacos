<?php

namespace alibaba\nacos\request\discovery;

class DeleteInstanceDiscovery extends DiscoveryRequest
{
    protected $uri = "/nacos/v1/ns/instance";
    protected $verb = "DELETE";

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
     * 集群名
     *
     * @var
     */
    private $clusterName;

    /**
     * 命名空间ID
     *
     * @var
     */
    private $namespaceId;

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
    public function getClusterName()
    {
        return $this->clusterName;
    }

    /**
     * @param mixed $clusterName
     */
    public function setClusterName($clusterName)
    {
        $this->clusterName = $clusterName;
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
}
