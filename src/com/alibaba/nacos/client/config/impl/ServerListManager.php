<?php


namespace com\alibaba\nacos\client\config\impl;


use com\alibaba\nacos\api\exception\NacosException;
use com\alibaba\nacos\api\PropertyKeyConst;

class ServerListManager
{
    private const HTTPS = "https://";
    private const HTTP = "http://";
    private const DEFAULT_SERVER_PORT = 9848;
    private const FIXED_NAME = "fixed";
    /**
     * @var array
     */
    private $serverList;
    /**
     * @var array
     */
    private $serversFromEndpoint;

    private $currentIndex = 0;

    /**
     * ServerListManager constructor.
     */
    public function __construct($properties)
    {
        $this->namespace = $properties[PropertyKeyConst::NAMESPACE] ?? '';
        $serverAddrStr = $properties[PropertyKeyConst::SERVER_ADDR];

        $endpoint = $properties[PropertyKeyConst::ENDPOINT] ?? '';
        $endpointPort = $properties[PropertyKeyConst::ENDPOINT_PORT] ?? 8080;

        if (!empty($serverAddrStr)) {
            $serverAddrs = [];
            foreach (preg_split("/,/", $serverAddrStr) as $serverAddr) {
                if (strpos($serverAddr, self::HTTP) === 0 || strpos($serverAddr, self::HTTPS) === 0) {
                    $serverAddrs[] = $serverAddr;
                } else {
                    $serverAddrArr = preg_split("/:/", $serverAddr);
                    if (count($serverAddrArr) === 1) {
                        $serverAddrs[] = $serverAddrArr[0] . ':' . self::DEFAULT_SERVER_PORT;
                    } else {
                        $serverAddrs[] = $serverAddr;
                    }
                }
            }
            $this->serverList = $serverAddrs;
            if (empty($this->namespace)) {
                $this->name = self::FIXED_NAME . "-" . self::getFixedNameSuffix($this->serverList);
            } else {
                $this->name = self::FIXED_NAME . "-" . self::getFixedNameSuffix($this->serverList) . '-' . $this->namespace;
            }
        } else {
            if (empty($endpoint)) {
                throw new NacosException(NacosException::CLIENT_INVALID_PARAM, "endpoint is blank");
            }
            if (empty($this->namespace)) {
                $this->name = $endpoint;
                // TODO fix
                $this->serversFromEndpoint = "http://${endpoint}:${endpointPort}/nacos/serverlist";
            } else {
                $this->name = $endpoint . "-" . $this->namespace;
                $this->serversFromEndpoint = "http://${endpoint}:${endpointPort}/nacos/serverlist?namespace=" . urlencode($this->namespace);
            }
        }
    }

    private static function getFixedNameSuffix($serverUrls)
    {
        $ret = "";
        foreach ($serverUrls as $serverUrl) {
            $serverUrl = preg_replace("/http(s)?:\/\//", "", $serverUrl);
            $serverUrl = preg_replace("/:/", "_", $serverUrl);
            $ret .= $serverUrl;
            $ret .= '-';
        }
        return $ret;
    }

    public function getServerList(): array
    {
        if (empty($this->serverList)) {
            return $this->serversFromEndpoint;
        } else {
            return $this->serverList;
        }
    }

    public function genNextServer(): string
    {
        $this->currentIndex++;
        $sList = $this->getServerList();
        $index = $this->currentIndex % count($sList);
        return $sList[$index];
    }
}
