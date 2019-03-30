<?php

namespace tests\request\discovery;

use alibaba\nacos\model\Instance;
use alibaba\nacos\request\discovery\GetInstanceDiscovery;
use tests\TestCase;

class GetInstanceDiscoveryTest extends TestCase
{

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $getInstanceDiscovery = new GetInstanceDiscovery();
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
