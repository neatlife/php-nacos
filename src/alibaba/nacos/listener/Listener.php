<?php


namespace alibaba\nacos\listener;


class Listener
{
    //定义一个观察者数组
    protected static $observers = array();

    //增加观察者方法
    public static function add(Callable $observer)
    {
        static::$observers[] = $observer;
    }

    //增加观察者方法
    public static function delete(Callable $observer)
    {
        foreach (static::$observers as $key => $obs) {
            if ($obs == $observer) {
                unset(static::$observers[$key]);
                return true;
            }
        }
        return false;
    }

    // 通知观察者
    public static function notify()
    {
        foreach (static::$observers as $observer) {
            call_user_func_array($observer, func_get_args());
        }
    }

    /**
     * @return array
     */
    public static function getObservers()
    {
        return static::$observers;
    }
}