<?php

namespace tests\request\naming;

use tests\TestCase;
use ReflectionException;
use alibaba\nacos\model\Instance;
use alibaba\nacos\request\naming\GetInstanceNaming;
use alibaba\nacos\exception\ResponseCodeErrorException;
use alibaba\nacos\exception\RequestUriRequiredException;
use alibaba\nacos\exception\RequestVerbRequiredException;

class GetInstanceNamingTest extends TestCase
{

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $getInstanceDiscovery = new GetInstanceNaming();
        $getInstanceDiscovery->setServiceName("nacos.test.1");
        $getInstanceDiscovery->setIp("11.11.11.11");
        $getInstanceDiscovery->setPort("8848");
        $getInstanceDiscovery->setNamespaceId("");
        $getInstanceDiscovery->setCluster("");
        $getInstanceDiscovery->setHealthyOnly(false);

        $response = $getInstanceDiscovery->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);

        var_dump(Instance::decode($content));
        var_dump(Instance::decode($content)->encode());
    }
}
