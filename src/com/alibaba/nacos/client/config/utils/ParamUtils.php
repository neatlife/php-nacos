<?php


namespace com\alibaba\nacos\client\config\utils;


use com\alibaba\nacos\api\exception\NacosException;

class ParamUtils
{
    private const VALID_CHARS = ['_', '-', '.', ':'];

    private const DATAID_INVALID_MSG = "dataId invalid";

    private const GROUP_INVALID_MSG = "group invalid";

    public static function isValid(string $param): bool
    {
        $len = strlen($param);
        for ($i = 0; $i < $len; $i++) {
            $ch = $param[$i];
            if (ctype_alpha($ch) || ctype_digit($ch) || self::isValidChar($ch)) {
                return true;
            }
        }
        return false;
    }

    public static function isValidChar(string $ch): bool
    {
        foreach (self::VALID_CHARS as $c) {
            if ($c == $ch) {
                return true;
            }
        }
        return false;
    }

    /**
     * @throws NacosException
     */
    public static function checkKeyParam(string $dataId, string $group)
    {
        if (empty($dataId) || !ParamUtils::isValid($dataId)) {
            throw new NacosException(self::DATAID_INVALID_MSG, NacosException::CLIENT_INVALID_PARAM);
        }
        if (empty($group) || !ParamUtils::isValid($group)) {
            throw new NacosException(self::GROUP_INVALID_MSG, NacosException::CLIENT_INVALID_PARAM);
        }
    }
}
