<?php

namespace tests\request\discovery;

use alibaba\nacos\request\discovery\BeatInstanceDiscovery;
use tests\TestCase;

class BeatInstanceDiscoveryTest extends TestCase
{

    private $beat = '{"metadata":{},"instanceId":"11.11.11.11#8848#DEFAULT#nacos.test.1","port":8848,"service":"nacos.test.1","healthy":true,"ip":"11.11.11.11","clusterName":"DEFAULT","weight":1.0}';

    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $beatInstanceDiscovery = new BeatInstanceDiscovery();
        $beatInstanceDiscovery->setServiceName("nacos.test.1");
        $beatInstanceDiscovery->setBeat($this->beat);

        $response = $beatInstanceDiscovery->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);
        $this->assertTrue($content == '{"clientBeatInterval":5000}');
    }
}
