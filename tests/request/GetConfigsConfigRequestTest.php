<?php

namespace tests\request;

use alibaba\nacos\NacosConfig;
use alibaba\nacos\request\config\GetConfigsConfigRequest;
use tests\TestCase;

/**
 * Class GetConfigsConfigRequestTest
 * @author suxiaolin
 * @package tests\request
 */
class GetConfigsConfigRequestTest extends TestCase
{
    /**
     * @throws \ReflectionException
     * @throws \alibaba\nacos\exception\RequestUriRequiredException
     * @throws \alibaba\nacos\exception\RequestVerbRequiredException
     * @throws \alibaba\nacos\exception\ResponseCodeErrorException
     */
    public function testDoRequest()
    {
        $getConfigsConfigRequest = new GetConfigsConfigRequest();
        $getConfigsConfigRequest->setDataId("LARAVEL");
        $getConfigsConfigRequest->setGroup("DEFAULT_GROUP");

        $response = $getConfigsConfigRequest->doRequest();
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        $content = $response->getBody()->getContents();
        echo "md5: " . md5($content);
        $this->assertEquals(md5($content), "d10d54edbdf4c99f6bbab4ef69292046");
        file_put_contents("env-example", $content);
    }
}
