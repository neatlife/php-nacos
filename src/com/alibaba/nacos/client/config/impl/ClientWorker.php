<?php

namespace com\alibaba\nacos\client\config\impl;

use com\alibaba\nacos\api\exception\NacosException;
use com\alibaba\nacos\client\config\common\ConfigConstants;
use com\alibaba\nacos\client\config\filter\impl\ConfigResponse;
use com\alibaba\nacos\common\remote\client\RpcClient;

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

    public function publishConfig(string $dataId, string $group, string $tenant, string $content): bool
    {
        $jsonValue = $this->agent->publishConfig($dataId, $group, $tenant, $content);
        $jsonArr = json_decode($jsonValue, true);
        if ($jsonArr['resultCode'] != 200) {
            throw new NacosException($jsonArr['message'], NacosException::CLIENT_INVALID_PARAM);
        }
        return true;
    }

    public function removeConfig(string $dataId, string $group,string $tenant): bool
    {
        $jsonValue = $this->agent->removeConfig($dataId, $group, $tenant);
        $jsonArr = json_decode($jsonValue, true);
        if ($jsonArr['resultCode'] != 200) {
            throw new NacosException($jsonArr['message'], NacosException::CLIENT_INVALID_PARAM);
        }
        return true;
    }
}
