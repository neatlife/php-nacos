<?php

namespace tests\request\discovery;

use alibaba\nacos\request\discovery\RegisterInstanceDiscovery;
use tests\TestCase;

class RegisterInstanceDiscoveryTest extends TestCase
{

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $registerInstanceDiscovery = new RegisterInstanceDiscovery();
        $registerInstanceDiscovery->setIp("11.11.11.12");
        $registerInstanceDiscovery->setPort("8848");
        $registerInstanceDiscovery->setNamespaceId("");
        $registerInstanceDiscovery->setWeight(1.0);
        $registerInstanceDiscovery->setEnable(true);
        $registerInstanceDiscovery->setHealthy(true);
        $registerInstanceDiscovery->setMetadata('{"sn": 12345}');
        $registerInstanceDiscovery->setClusterName("");
        $registerInstanceDiscovery->setServiceName("nacos.test.1");

        $response = $registerInstanceDiscovery->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);
        $this->assertTrue($content == "ok");
    }
}
