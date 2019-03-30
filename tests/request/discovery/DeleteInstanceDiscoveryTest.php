<?php

namespace tests\request\discovery;

use alibaba\nacos\request\discovery\DeleteInstanceDiscovery;
use tests\TestCase;

class DeleteInstanceDiscoveryTest extends TestCase
{

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $deleteInstanceDiscovery = new DeleteInstanceDiscovery();
        $deleteInstanceDiscovery->setIp("11.11.11.12");
        $deleteInstanceDiscovery->setPort("8848");
        $deleteInstanceDiscovery->setNamespaceId("");
        $deleteInstanceDiscovery->setClusterName("");
        $deleteInstanceDiscovery->setServiceName("nacos.test.1");

        $response = $deleteInstanceDiscovery->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);
        $this->assertTrue($content == "ok");
    }
}
