<?php


namespace alibaba\nacos\model;


class Host extends Model
{
    protected $valid; //boolean
    protected $marked; //boolean
    protected $metadata; //
    protected $instanceId; //String
    protected $port; //int
    protected $ip; //String
    protected $clusterName; //String
    protected $weight; //double
    protected $serviceName; //String
    protected $enabled;

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return mixed
     */
    public function getMarked()
    {
        return $this->marked;
    }

    /**
     * @param mixed $marked
     */
    public function setMarked($marked)
    {
        $this->marked = $marked;
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
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    /**
     * @param mixed $instanceId
     */
    public function setInstanceId($instanceId)
    {
        $this->instanceId = $instanceId;
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
    } //boolean

}