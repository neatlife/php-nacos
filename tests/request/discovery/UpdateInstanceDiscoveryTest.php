<?php

namespace tests\request\discovery;

use alibaba\nacos\request\discovery\UpdateInstanceDiscovery;
use tests\TestCase;

class UpdateInstanceDiscoveryTest extends TestCase
{

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $updateInstanceDiscovery = new UpdateInstanceDiscovery();
        $updateInstanceDiscovery->setIp("11.11.11.12");
        $updateInstanceDiscovery->setPort("8848");
        $updateInstanceDiscovery->setNamespaceId("");
        $updateInstanceDiscovery->setWeight(0.5);
        $updateInstanceDiscovery->setMetadata('{"sn": 123456}');
        $updateInstanceDiscovery->setClusterName("");
        $updateInstanceDiscovery->setServiceName("nacos.test.1");

        $response = $updateInstanceDiscovery->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);
        $this->assertTrue($content == "ok");
    }
}
