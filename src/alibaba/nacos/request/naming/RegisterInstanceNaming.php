<?php

namespace alibaba\nacos\request\naming;

class RegisterInstanceNaming extends NamingRequest
{
    protected $uri = "/nacos/v1/ns/instance";
    protected $verb = "POST";

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
     * 权重
     *
     * @var
     */
    private $weight;

    /**
     * 是否上线
     *
     * @var
     */
    private $enabled;

    /**
     * 是否健康
     *
     * @var
     */
    private $healthy;

    /**
     * 扩展信息
     *
     * @var
     */
    private $metadata;

    /**
     * 集群名
     *
     * @var
     */
    private $clusterName;

    /**
     * 服务名
     *
     * @var
     */
    private $serviceName;

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
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return mixed
     */
    public function getHealthy()
    {
        return $this->healthy;
    }

    /**
     * @param mixed $healthy
     */
    public function setHealthy($healthy)
    {
        $this->healthy = $healthy;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param mixed $metadata
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
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
}
