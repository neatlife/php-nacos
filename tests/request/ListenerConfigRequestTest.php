<?php

namespace alibaba\nacos\request\config;


use tests\TestCase;

/**
 * Class ListenerConfigRequestTest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class ListenerConfigRequestTest extends TestCase
{
    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $listenerConfigRequest = new ListenerConfigRequest();
        $listenerConfigRequest->setDataId("LARAVEL");
        $listenerConfigRequest->setGroup("DEFAULT_GROUP");
        $listenerConfigRequest->setContentMD5("ddf41f9b16c588e0f6a185f4c82bf61d");

        $response = $listenerConfigRequest->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);
    }
}
