<?php

namespace alibaba\nacos\request\config;


use tests\TestCase;
use ReflectionException;
use alibaba\nacos\exception\ResponseCodeErrorException;
use alibaba\nacos\exception\RequestUriRequiredException;
use alibaba\nacos\exception\RequestVerbRequiredException;

/**
 * Class ListenerConfigRequestTest
 *
 * @author suxiaolin
 */
class PublishConfigRequestTest extends TestCase
{
    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $publishConfigRequest = new PublishConfigRequest();
        $publishConfigRequest->setDataId("LARAVEL");
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
