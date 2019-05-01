<?php

namespace alibaba\nacos\request\config;

use alibaba\nacos\NacosConfig;
use alibaba\nacos\util\LogUtil;
use alibaba\nacos\request\Request;
use alibaba\nacos\util\ReflectionUtil;

/**
 * Class ConfigRequest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class ConfigRequest extends Request
{
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

    protected function getParameterAndHeader()
    {
        $headers = [];
        $parameterList = [];

        $properties = ReflectionUtil::getProperties($this);
        foreach ($properties as $propertyName => $propertyValue) {
            if (in_array($propertyName, $this->standaloneParameterList)) {
                // 忽略这些参数
            } else if ($propertyName == "longPullingTimeout") {
                $headers["Long-Pulling-Timeout"] = $this->getLongPullingTimeout();
            } else if ($propertyName == "listeningConfigs") {
                $parameterList["Listening-Configs"] = $this->getListeningConfigs();
            } else {
                $parameterList[$propertyName] = $propertyValue;
            }
        }

        if (NacosConfig::getIsDebug()) {
            LogUtil::info(strtr("parameterList: {parameterList}, headers: {headers}", [
                "parameterList" => json_encode($parameterList),
                "headers" => json_encode($headers)
            ]));
        }
        return [$parameterList, $headers];
    }
}