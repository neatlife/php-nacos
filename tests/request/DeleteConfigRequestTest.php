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
        $deleteConfigsConfigRequest = new DeleteConfigsConfigRequest();
        $deleteConfigsConfigRequest->setDataId("LARAVEL1");
        $deleteConfigsConfigRequest->setGroup("DEFAULT_GROUP");

        $response = $deleteConfigsConfigRequest->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);
    }
}
