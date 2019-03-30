<?php

namespace alibaba\nacos\request\config;


use alibaba\nacos\Discovery;
use alibaba\nacos\model\Beat;
use alibaba\nacos\model\Instance;
use alibaba\nacos\model\InstanceList;
use alibaba\nacos\NacosConfig;

/**
 * Class DiscoveryTest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class DiscoveryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Discovery
     */
    private $discovery;

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testRegister()
    {
        $this->assertTrue($this->discovery->register());
    }

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDelete()
    {
        $this->assertTrue($this->discovery->delete());
    }

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testUpdate()
    {
        $this->assertTrue($this->discovery->update(0.8));
    }

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testListInstances()
    {
        $instanceList = $this->discovery->listInstances();
        $this->assertInstanceOf(InstanceList::class, $instanceList);
    }

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testGet()
    {
        $this->assertInstanceOf(Instance::class, $this->discovery->get());
    }

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testBeat()
    {
        $beat = $this->discovery->beat($this->discovery->get());
        $this->assertInstanceOf(Beat::class, $beat);
    }

    /**
     * This method is called before each test.
     */
    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        NacosConfig::setHost("http://127.0.0.1:8848/");
        NacosConfig::setIsDebug(true);
        // 长轮询10秒一次
        NacosConfig::setLongPullingTimeout(10000);
        $this->discovery = Discovery::init(
            "nacos.test.1",
            "11.11.11.11",
            "8848"
        );
    }
}
