<?php


namespace alibaba\nacos\request\naming;


use alibaba\nacos\NacosConfig;
use alibaba\nacos\NamingConfig;
use alibaba\nacos\util\LogUtil;
use alibaba\nacos\request\Request;
use alibaba\nacos\util\ReflectionUtil;

class NamingRequest extends Request
{

    protected function getParameterAndHeader()
    {
        $headers = [];
        $parameterList = [];

        $properties = ReflectionUtil::getProperties($this);
        foreach ($properties as $propertyName => $propertyValue) {
            if (in_array($propertyName, $this->standaloneParameterList)) {
                // 忽略这些参数
            } else {
                $parameterList[$propertyName] = $propertyValue;
            }
        }

        if ($this instanceof RegisterInstanceNaming) {
            $parameterList["ephemeral"] = NamingConfig::getEphemeral();
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