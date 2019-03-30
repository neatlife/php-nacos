<?php


namespace alibaba\nacos\request\discovery;


use alibaba\nacos\NacosConfig;
use alibaba\nacos\request\Request;
use alibaba\nacos\util\LogUtil;
use alibaba\nacos\util\ReflectionUtil;

class DiscoveryRequest extends Request
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

        if (NacosConfig::getIsDebug()) {
            LogUtil::info(strtr("parameterList: {parameterList}, headers: {headers}", [
                "parameterList" => json_encode($parameterList),
                "headers" => json_encode($headers)
            ]));
        }
        return [$parameterList, $headers];
    }

}