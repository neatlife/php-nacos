<?php

namespace alibaba\nacos\request\config;


use tests\TestCase;

/**
 * Class ListenerConfigRequestTest
 *
 * @author suxiaolin
 */
class PublishConfigRequestTest extends TestCase
{
    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $publishConfigRequest = new PublishConfigRequest();
        $publishConfigRequest->setDataId("LARAVEL1");
        $publishConfigRequest->setGroup("DEFAULT_GROUP");
        $publishConfigRequest->setContent(file_get_contents("env-example"));

        $response = $publishConfigRequest->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "content: " . $content;
        $this->assertNotEmpty($content);
    }
}
