<?php


namespace tests;


use alibaba\nacos\NacosConfig;

/**
 * Class TestCase
 * @author suxiaolin
 * @package tests
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * This method is called before each test.
     */
    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        NacosConfig::setHost("http://127.0.0.1:8848/");
        NacosConfig::setIsDebug(true);
    }
}