<?php

namespace com\alibaba\nacos\client\config\filter\impl;

use com\alibaba\nacos\api\config\filter\IConfigRequest;

class ConfigRequest implements IConfigRequest
{
    private $param = [];

    function putParameter(string $key, string $value)
    {
        $this->param[$key] = $value;
    }

    function getParameter($key): string
    {
        return $this->param[$key];
    }
}
