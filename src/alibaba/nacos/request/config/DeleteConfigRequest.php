<?php

namespace alibaba\nacos\request\config;

/**
 * Class DeleteConfigRequest
 * @author suxiaolin
 * @package alibaba\nacos\request\config
 */
class DeleteConfigRequest extends ConfigRequest
{
    protected $uri = "/nacos/v1/cs/configs";
    protected $verb = "DELETE";
}