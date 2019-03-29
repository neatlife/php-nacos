<?php

namespace tests\util;


use alibaba\nacos\util\EncodeUtil;
use alibaba\nacos\util\LogUtil;
use tests\TestCase;

/**
 * Class EncodeTest
 * @author suxiaolin
 * @package tests\util
 */
class EncodeTest extends TestCase
{
    public function testOneEncode()
    {
        $this->assertNotEmpty(EncodeUtil::oneEncode());
    }

    public function testTwoEncode()
    {
        $this->assertNotEmpty(EncodeUtil::twoEncode());
    }
}
