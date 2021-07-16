<?php

namespace com\alibaba\nacos\client\config\impl;

use com\alibaba\nacos\client\config\common\ConfigConstants;
use com\alibaba\nacos\client\config\filter\impl\ConfigResponse;
use com\alibaba\nacos\common\remote\client\RpcClient;
use Psr\Log\LoggerInterface;

class ClientWorker
{

    /**
     * @var RpcClient
     */
    private $agent;

    public function __construct($serverListManager, $properties)
    {
        $rpcClient = new RpcClient($properties, $serverListManager);
        $rpcClient->start();
        $this->agent = $rpcClient;
    }

    public function getServerConfig(string $dataId, string $group, string $tenant, int $readTimeout, bool $notify): ConfigResponse
    {
        $jsonValue = $this->agent->queryConfig($dataId, $group, $tenant, $readTimeout, $notify);
        $jsonArr = json_decode($jsonValue, true);
        $configResponse = new ConfigResponse();
        $configResponse->putParameter(ConfigConstants::TENANT, $tenant);
        $configResponse->putParameter(ConfigConstants::DATA_ID, $dataId);
        $configResponse->putParameter(ConfigConstants::GROUP, $group);
        $configResponse->putParameter(ConfigConstants::CONTENT, $jsonArr['content']);
        $configResponse->putParameter(ConfigConstants::CONFIG_TYPE, $jsonArr['contentType']);
        $configResponse->putParameter(ConfigConstants::ENCRYPTED_DATA_KEY, $jsonArr['encryptedDataKey']);
        return $configResponse;
    }
}
