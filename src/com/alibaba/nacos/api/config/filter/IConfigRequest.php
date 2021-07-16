<?php


namespace com\alibaba\nacos\api\config\filter;


interface IConfigRequest
{
    function putParameter(string $key, string $value);

    function getParameter($key): string;
}
