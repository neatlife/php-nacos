<?php

namespace com\alibaba\nacos\client\config\filter\impl;

use com\alibaba\nacos\api\config\filter\IConfigResponse;

class ConfigResponse implements IConfigResponse
{
    private $param = [];

    function getParameter(string $key): string
    {
        return $this->param[$key];
    }

    function putParameter(string $key, string $value)
    {
        $this->param[$key] = $value;
    }
}
