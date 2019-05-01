<?php

namespace tests\util;


use Exception;
use tests\TestCase;
use alibaba\nacos\util\LogUtil;

/**
 * Class LogUtilTest
 * @author suxiaolin
 * @package tests\util
 */
class LogUtilTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testInfo()
    {
        $this->assertEmpty(LogUtil::info("info message"));
    }
}
