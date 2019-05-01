<?php

namespace tests\util;

use tests\TestCase;
use alibaba\nacos\util\HttpUtil;

/**
 * Class HttpUtilTest
 * @author suxiaolin
 * @package tests\util
 */
class HttpUtilTest extends TestCase
{
    public function testGet()
    {
        $parameterList = [
            "dataId" => "LARAVEL",
            "group" => "DEFAULT_GROUP"
        ];
        $response = HttpUtil::request("GET", "/nacos/v1/cs/configs", $parameterList);
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getBody());
        file_put_contents("env-example", $response->getBody()->getContents());
    }

    public function testPost()
    {
        $parameterList = [
            "Listening-Configs" => "LARAVEL^2DEFAULT_GROUP^2ddf41f9b16c588e0f6a185f4c82bf61d^1"
        ];
        $headers = [
            "Long-Pulling-Timeout" => "3000",
            "Content-Type" => "application/x-www-form-urlencoded"
        ];
        $response = HttpUtil::request("POST", "/nacos/v1/cs/configs/listener", $parameterList, $headers, ['debug' => true]);
        $this->assertNotEmpty($response);
    }
}
