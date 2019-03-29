<?php


namespace alibaba\nacos\enum;


/**
 * Class ErrorCodeEnum
 * @author suxiaolin
 * @package alibaba\nacos\enum
 */
class ErrorCodeEnum
{
    /**
     * 错误列表
     *
     * @return array
     */
    public static function getErrorCodeMap()
    {
        return [
            400 => "客户端请求中的语法错误",
            403 => "没有权限",
            404 => "无法找到资源",
            500 => "服务器内部错误",
        ];
    }
}