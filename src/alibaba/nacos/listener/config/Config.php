<?php


namespace alibaba\nacos\listener\config;


class Config
{
    private $env;

    /**
     * 租户信息，对应 Nacos 的命名空间字段。
     * @var
     */
    private $tenant;

    /**
     * 配置 ID
     * @var
     */
    private $dataId;

    /**
     * 配置分组。
     * @var
     */
    private $group;

    /**
     * @var string 当前配置
     */
    private $config;

    private $changed = false;

    public static function of($env, $tenant, $dataId, $group, $configString)
    {
        $config = new Config();
        $config->setEnv($env);
        $config->setTenant($tenant);
        $config->setDataId($dataId);
        $config->setGroup($group);
        $config->setConfig($configString);
        return $config;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param mixed $tenant
     */
    public function setTenant($tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * @return mixed
     */
    public function getDataId()
    {
        return $this->dataId;
    }

    /**
     * @param mixed $dataId
     */
    public function setDataId($dataId)
    {
        $this->dataId = $dataId;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
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
     * @return bool
     */
    public function isChanged()
    {
        return $this->changed;
    }

    /**
     * @param bool $changed
     */
    public function setChanged($changed)
    {
        $this->changed = $changed;
    }
}