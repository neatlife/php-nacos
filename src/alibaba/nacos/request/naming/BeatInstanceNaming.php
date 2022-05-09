<?php

namespace alibaba\nacos\request\naming;

class BeatInstanceNaming extends NamingRequest
{
    protected $uri = "/nacos/v1/ns/instance/beat";
    protected $verb = "PUT";

    /**
     * 服务名
     *
     * @var
     */
    private $serviceName;

    /**
     * IP
     *
     * @var
     */
    private $ip;

    /**
     * PORT
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
     * 实例心跳内容
     *
     * @var
     */
    private $beat;

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
    public function getBeat()
    {
        return $this->beat;
    }

    /**
     * @param mixed $beat
     */
    public function setBeat($beat)
    {
        $this->beat = $beat;
    }
}
