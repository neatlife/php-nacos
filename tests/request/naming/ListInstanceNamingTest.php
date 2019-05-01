<?php

namespace tests\request\naming;

use tests\TestCase;
use ReflectionException;
use alibaba\nacos\model\InstanceList;
use alibaba\nacos\request\naming\ListInstanceNaming;
use alibaba\nacos\exception\ResponseCodeErrorException;
use alibaba\nacos\exception\RequestUriRequiredException;
use alibaba\nacos\exception\RequestVerbRequiredException;

class RegisterInstanceDiscoveryTest extends TestCase
{

    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $listInstanceDiscovery = new ListInstanceNaming();
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
