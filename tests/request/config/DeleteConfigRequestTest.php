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
class DeleteConfigRequestTest extends TestCase
{
    /**
     * @throws ReflectionException
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
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
