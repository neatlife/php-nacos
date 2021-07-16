<?php


namespace com\alibaba\nacos\api\utils;


class NetUtils
{
    private static $ip = null;

    public static function localIP(): string
    {
        if (self::$ip == null) {
            self::$ip = getHostByName(getHostName());
        }
        return self::$ip;
    }
}
