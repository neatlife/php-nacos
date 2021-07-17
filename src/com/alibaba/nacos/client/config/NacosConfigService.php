<?php


namespace com\alibaba\nacos\client\config;


use com\alibaba\nacos\api\common\Constants;
use com\alibaba\nacos\api\config\ConfigService;
use com\alibaba\nacos\api\exception\NacosException;
use com\alibaba\nacos\api\PropertyKeyConst;
use com\alibaba\nacos\client\config\common\ConfigConstants;
use com\alibaba\nacos\client\config\impl\ClientWorker;
use com\alibaba\nacos\client\config\impl\ServerListManager;
use com\alibaba\nacos\client\config\utils\ParamUtils;

class NacosConfigService implements ConfigService
{
    private $namespace;
    /**
     * @var ClientWorker
     */
    private $clientWorker;

    /**
     * NacosConfigService constructor.
     * @param $properties string[]
     * @throws NacosException
     */
    public function __construct($properties)
    {
        $this->namespace = $properties[PropertyKeyConst::NAMESPACE] ?? '';

        $serverListManager = new ServerListManager($properties);
        $this->clientWorker = new ClientWorker($serverListManager, $properties);
    }

    function getConfig(string $dataId, string $group, int $timeoutMs): string
    {
        $group = $this->blank2defaultGroup($group);
        ParamUtils::checkKeyParam($dataId, $group);
        $configResponse = $this->clientWorker->getServerConfig($dataId, $group, $this->namespace, $timeoutMs, false);
        return $configResponse->getParameter(ConfigConstants::CONTENT);
    }

    function publishConfig(string $dataId, string $group, string $content): bool
    {
        $group = $this->blank2defaultGroup($group);
        ParamUtils::checkParam($dataId, $group, $content);
        return $this->clientWorker->publishConfig($dataId, $group, $this->namespace, $content);
    }

    function removeConfig(string $dataId, string $group): bool
    {
        // TODO: Implement removeConfig() method.
    }

    private function blank2defaultGroup(string $group): string
    {
        return empty($group) ? Constants::DEFAULT_GROUP : trim($group);
    }
}
