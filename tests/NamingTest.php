<?php

namespace alibaba\nacos\request\config;


use ReflectionException;
use alibaba\nacos\Naming;
use alibaba\nacos\model\Beat;
use alibaba\nacos\NacosConfig;
use PHPUnit\Framework\TestCase;
use alibaba\nacos\model\Instance;
use alibaba\nacos\model\InstanceList;
use alibaba\nacos\exception\ResponseCodeErrorException;
use alibaba\nacos\exception\RequestUriRequiredException;
use alibaba\nacos\exception\RequestVerbRequiredException;

/**
 * Class NamingTest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class NamingTest extends TestCase
{
    /**
     * This method is called before each test.
     */
    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        NacosConfig::setHost("http://127.0.0.1:8848/");
        NacosConfig::setIsDebug(true);
        // 长轮询10秒一次
        NacosConfig::setLongPullingTimeout(10000);
        $this->discovery = Naming::init(
            "nacos.test.1",
            "11.11.11.11",
            "8848"
        );
    }

    /**
     * @var Naming
     */
    private $discovery;

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testRegister()
    {
        $this->assertTrue($this->discovery->register());
    }

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testDelete()
    {
        $this->assertTrue($this->discovery->delete());
    }

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testUpdate()
    {
        $this->assertTrue($this->discovery->update(0.8));
    }

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testListInstances()
    {
        $instanceList = $this->discovery->listInstances();
        $this->assertInstanceOf(InstanceList::class, $instanceList);
    }

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testGet()
    {
        $this->assertInstanceOf(Instance::class, $this->discovery->get());
    }

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testBeat()
    {
        $beat = $this->discovery->beat($this->discovery->get());
        $this->assertInstanceOf(Beat::class, $beat);
    }
}
