<?php

namespace alibaba\nacos\request\config;


use tests\TestCase;

/**
 * Class ListenerConfigRequestTest
 *
 * @author suxiaolin
 */
class DeleteConfigRequestTest extends TestCase
{
    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $deleteConfigRequest = new DeleteConfigRequest();
        $deleteConfigRequest->setDataId("LARAVEL1");
        $deleteConfigRequest->setGroup("DEFAULT_GROUP");

        $response = $deleteConfigRequest->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);
    }
}
