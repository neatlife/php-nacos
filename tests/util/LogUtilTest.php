<?php

namespace tests\util;


use alibaba\nacos\util\LogUtil;
use tests\TestCase;

/**
 * Class LogUtilTest
 * @author suxiaolin
 * @package tests\util
 */
class LogUtilTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testInfo()
    {
        $this->assertEmpty(LogUtil::info("info message"));
    }
}
