<?php

namespace tests\listener\config;

use alibaba\nacos\listener\config\GetConfigRequestErrorListener;
use alibaba\nacos\Nacos;

class GetConfigRequestErrorListenerTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testNotify()
    {
        GetConfigRequestErrorListener::add(function($config) {
            if (!$config->getConfig()) {
                echo "获取配置异常, 配置为空，下面进行自定义逻辑处理" . PHP_EOL;
                // 设置是否修改配置文件内容，如果修改成true，这里设置的配置文件内容将是最终获取到的配置文件
                $config->setChanged(true);
                $config->setConfig("hello");
            }
        });
        $config = Nacos::init(
            "http://127.0.0.1:8848/",
            "dev",
            "LARAVEL",
            "DEFAULT_GROUP",
            ""
        )->runOnce();

        $this->assertNotEmpty($config);
        $this->assertEquals($config, "hello");
    }
}
