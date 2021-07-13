<?php


namespace com\alibaba\nacos;


use com\alibaba\nacos\api\config\ConfigService;
use com\alibaba\nacos\api\PropertyKeyConst;
use com\alibaba\nacos\client\config\NacosConfigService;
use com\alibaba\nacos\client\utils\ParamUtil;

class NacosFactory
{
    /**
     * @param $properties string[]
     * @return ConfigService
     */
    public static function createConfigService($properties)
    {
        $configService = new NacosConfigService($properties);
        return $configService;
    }
}