<?php

namespace alibaba\nacos\request\config;

/**
 * Class GetConfigsConfigRequest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class GetConfigsConfigRequest extends ConfigRequest
{
    protected $uri = "/nacos/v1/cs/configs";
    protected $verb = "GET";

    /**
     * @return array
     */
    public function getErrorCodeMap()
    {
        return [
            400 => "客户端请求中的语法错误",
            403 => "没有权限",
            404 => "无法找到资源",
            500 => "服务器内部错误",
            200 => "正常"
        ];
    }

}