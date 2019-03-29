<?php

namespace alibaba\nacos\request\config;

use alibaba\nacos\NacosConfig;
use alibaba\nacos\util\EncodeUtil;

/**
 * Class ListenerConfigRequest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class ListenerConfigRequest extends ConfigRequest
{
    /**
     * 监听数据报文。格式为 dataId^2Group^2contentMD5^2tenant^1或者dataId^2Group^2contentMD5^1。
     */
    const LISTENING_CONFIGS_FORMAT = "%s%s%s%s%s%s%s%s";

    protected $uri = "/nacos/v1/cs/configs/listener";
    protected $verb = "POST";

    /**
     * 监听数据报文
     * @var
     */
    private $listeningConfigs;

    /**
     * 配置内容 MD5 值
     *
     * @var
     */
    private $contentMD5;

    /**
     * @var int 长轮询等待时间, 默认30秒
     */
    private $longPullingTimeout = 30000;

    /**
     * @return int
     */
    public function getLongPullingTimeout()
    {
        if (NacosConfig::getLongPullingTimeout()) {
            return NacosConfig::getLongPullingTimeout();
        } else {
            return $this->longPullingTimeout;
        }
    }

    /**
     * @return mixed
     */
    public function getListeningConfigs()
    {
        $this->listeningConfigs = sprintf(
            self::LISTENING_CONFIGS_FORMAT,
            $this->getDataId(),
            EncodeUtil::twoEncode(),
            $this->getGroup(),
            EncodeUtil::twoEncode(),
            $this->getContentMD5(),
            EncodeUtil::twoEncode(),
            $this->getTenant(),
            EncodeUtil::oneEncode()
        );
        return $this->listeningConfigs;
    }

    /**
     * @return mixed
     */
    public function getContentMD5()
    {
        return $this->contentMD5;
    }

    /**
     * @param mixed $contentMD5
     */
    public function setContentMD5($contentMD5)
    {
        $this->contentMD5 = $contentMD5;
    }
}