<?php

namespace tests\request\naming;

use alibaba\nacos\exception\RequestUriRequiredException;
use alibaba\nacos\exception\RequestVerbRequiredException;
use alibaba\nacos\exception\ResponseCodeErrorException;
use alibaba\nacos\request\naming\DeleteInstanceNaming;
use ReflectionException;
use tests\TestCase;

class DeleteInstanceNamingTest extends TestCase
{

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $deleteInstanceDiscovery = new DeleteInstanceNaming();
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
