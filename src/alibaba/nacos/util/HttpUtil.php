<?php


namespace alibaba\nacos\util;


use GuzzleHttp\Client;
use alibaba\nacos\NacosConfig;

/**
 * Class HttpUtil
 * @author suxiaolin
 * @package alibaba\nacos\util
 */
class HttpUtil
{
    public static function request($verb, $uri, $body = [], $headers = [], $options = [])
    {
        //这个主要是为了解决 http_build_query 会转布尔型转换成0和1的问题
        foreach ($body as &$value){
            if (is_bool($value)) {
                $value = $value ? "true" : "false";
            }
        }
        
        $httpClient = self::getGuzzle();
        $parameterList = [
            'headers' => $headers,
        ];
        if ($verb == "GET") {
            $parameterList['query'] = $body;
        } else {
            $parameterList['form_params'] = $body;
        }
        $response = $httpClient->request($verb, $uri, array_merge($parameterList, $options));
        return $response;
    }

    /**
     * @param $host
     * @param $timeout
     * @return Client
     */
    public static function getGuzzle()
    {
        static $guzzle;
        if ($guzzle == null) {
            $guzzle = new Client([
                'base_uri' => NacosConfig::getHost(),
            ]);
        }
        return $guzzle;
    }
}
