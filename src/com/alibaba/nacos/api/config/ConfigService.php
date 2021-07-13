<?php


namespace com\alibaba\nacos\api\config;


interface ConfigService
{
    function getConfig(string $dataId, string $group, int $timeoutMs): string;

    function publishConfig(string $dataId, string $group, string $content): bool;

    function removeConfig(string $dataId, string $group): bool;
}
