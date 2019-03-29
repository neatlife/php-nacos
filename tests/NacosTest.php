<?php

namespace alibaba\nacos\request\config;


use alibaba\nacos\failover\LocalConfigInfoProcessor;
use alibaba\nacos\Nacos;
use alibaba\nacos\NacosConfig;

/**
 * Class NacosTest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class NacosTest extends \PHPUnit\Framework\TestCase
{
    /**
     * This method is called before each test.
     */
    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        NacosConfig::setIsDebug(true);
        // 长轮询10秒一次
        NacosConfig::setLongPullingTimeout(10000);
    }

    public function testRunOnce()
    {
        Nacos::init(
            "http://127.0.0.1:8848/",
            "dev",
            "LARAVEL",
            "DEFAULT_GROUP",
            ""
        )->runOnce();
        $this->assertFileExists(
            LocalConfigInfoProcessor::getSnapshotFile(
                "dev",
                "LARAVEL",
                "DEFAULT_GROUP",
                ""
            )
        );
    }

    public function testListener() {
        Nacos::init(
            "http://127.0.0.1:8848/",
            "dev",
            "LARAVEL",
            "DEFAULT_GROUP",
            ""
        )->listener();
    }
}
