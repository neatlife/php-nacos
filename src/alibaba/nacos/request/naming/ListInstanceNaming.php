<?php

namespace alibaba\nacos\request\naming;

class ListInstanceNaming extends NamingRequest
{
    protected $uri = "/nacos/v1/ns/instance/list";
    protected $verb = "GET";

    /**
     * 服务名
     *
     * @var
     */
    private $serviceName;

    /**
     * 命名空间ID
     *
     * @var
     */
    private $namespaceId;

    /**
     * 集群名称 多个集群用逗号分隔
     * @var
     */
    private $clusters;

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
    public function getClusters()
    {
        return $this->clusters;
    }

    /**
     * @param mixed $clusters
     */
    public function setClusters($clusters)
    {
        $this->clusters = $clusters;
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
