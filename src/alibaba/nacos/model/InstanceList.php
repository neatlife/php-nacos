<?php


namespace alibaba\nacos\model;


use alibaba\nacos\util\MapperUtil;

class InstanceList extends Model
{
    protected $metadata; //Metadata
    protected $dom; //String
    protected $cacheMillis; //int
    protected $useSpecifiedURL; //boolean
    protected $hosts; //array(Host)
    protected $checksum; //String
    protected $lastRefTime; //long
    protected $env; //String
    protected $clusters;
    protected $name; // String

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
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * @param mixed $dom
     */
    public function setDom($dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return mixed
     */
    public function getCacheMillis()
    {
        return $this->cacheMillis;
    }

    /**
     * @param mixed $cacheMillis
     */
    public function setCacheMillis($cacheMillis)
    {
        $this->cacheMillis = $cacheMillis;
    }

    /**
     * @return mixed
     */
    public function getUseSpecifiedURL()
    {
        return $this->useSpecifiedURL;
    }

    /**
     * @param mixed $useSpecifiedURL
     */
    public function setUseSpecifiedURL($useSpecifiedURL)
    {
        $this->useSpecifiedURL = $useSpecifiedURL;
    }

    /**
     * @return mixed
     */
    public function getHosts()
    {
        $hostsList = [];
        foreach ($this->hosts as $host) {
            $hostsList[] = MapperUtil::objectToObject($host, "alibaba\\nacos\\model\\Host");
        }
        return $hostsList;
    }

    /**
     * @param mixed $hosts
     */
    public function setHosts($hosts)
    {
        $this->hosts = $hosts;
    }

    /**
     * @return mixed
     */
    public function getChecksum()
    {
        return $this->checksum;
    }

    /**
     * @param mixed $checksum
     */
    public function setChecksum($checksum)
    {
        $this->checksum = $checksum;
    }

    /**
     * @return mixed
     */
    public function getLastRefTime()
    {
        return $this->lastRefTime;
    }

    /**
     * @param mixed $lastRefTime
     */
    public function setLastRefTime($lastRefTime)
    {
        $this->lastRefTime = $lastRefTime;
    }

    /**
     * @return mixed
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * @param mixed $env
     */
    public function setEnv($env)
    {
        $this->env = $env;
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
    } //String

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}