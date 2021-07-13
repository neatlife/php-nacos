<?php


namespace com\alibaba\nacos\api\config\filter;


interface IConfigResponse
{
    function getParameter(string $key): string;

    function putParameter(string $key, string $value);
}
