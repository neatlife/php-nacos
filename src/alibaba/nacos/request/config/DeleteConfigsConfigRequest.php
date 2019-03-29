<?php

namespace alibaba\nacos\request\config;

/**
 * Class DeleteConfigsConfigRequest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class DeleteConfigsConfigRequest extends ConfigRequest
{
    protected $uri = "/nacos/v1/cs/configs";
    protected $verb = "DELETE";
}