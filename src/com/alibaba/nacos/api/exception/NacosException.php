<?php


namespace com\alibaba\nacos\api\exception;


class NacosException extends \Exception
{
    /**
     * client error code
     * -400 -503 throw exception to user
     */
    /**
     * invalid param（参数错误）
     */
    public const CLIENT_INVALID_PARAM = -400;
    /**
     * over client threshold（超过server端的限流阈值）
     */
    public const CLIENT_OVER_THRESHOLD = -503;
}
