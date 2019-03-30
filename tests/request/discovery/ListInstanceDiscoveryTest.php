<?php

namespace tests\request\discovery;

use alibaba\nacos\model\InstanceList;
use alibaba\nacos\request\discovery\ListInstanceDiscovery;
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
        $listInstanceDiscovery = new ListInstanceDiscovery();
        $listInstanceDiscovery->setServiceName("nacos.test.1");
        $listInstanceDiscovery->setNamespaceId("");
        $listInstanceDiscovery->setClusters("");
        $listInstanceDiscovery->setHealthyOnly(false);

        $response = $listInstanceDiscovery->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);

        var_dump(InstanceList::decode($content));
        var_dump(InstanceList::decode($content)->getHosts());
    }
}
