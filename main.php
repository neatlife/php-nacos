<?php

require __DIR__ . '/vendor/autoload.php';

use \com\alibaba\nacos\NacosFactory;
use \com\alibaba\nacos\api\PropertyKeyConst;

$properties = [
    PropertyKeyConst::SERVER_ADDR => 'mse-189af104-p.nacos-ans.mse.aliyuncs.com'
];
$cs = NacosFactory::createConfigService($properties);

$dataId = "dataId";
$group = "group";

$cs->publishConfig($dataId, $group, "Content!");

$res = $cs->getConfig($dataId, $group, 5000);
var_dump($res);
