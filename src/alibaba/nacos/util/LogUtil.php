<?php


namespace alibaba\nacos\util;

use alibaba\nacos\NacosConfig;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class LogUtil
 * @author suxiaolin
 * @package alibaba\nacos\util
 */
class LogUtil
{
    /**
     * @param $message
     * @param $parameters
     */
    public static function info($message, $parameters = [])
    {
        self::getLog()->info($message, $parameters);
    }

    public static function getLog()
    {
        static $log;
        if ($log == null) {
            // create a log channel
            try {
                $log = new Logger(NacosConfig::getName());
                $log->pushHandler(new StreamHandler(NacosConfig::getLogPath(), NacosConfig::getLogLevel()));
            } catch (Exception $e) {
                echo "初始化日志系统失败";
                exit(255);
            }
        }
        return $log;
    }

    /**
     * @param $message
     * @param $parameters
     */
    public static function error($message, $parameters = [])
    {
        self::getLog()->error($message, $parameters);
    }
}