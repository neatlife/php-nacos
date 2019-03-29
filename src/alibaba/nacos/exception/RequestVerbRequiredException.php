<?php


namespace alibaba\nacos\exception;


use Exception;

/**
 * Class RequestVerbRequiredException
 * @author suxiaolin
 * @package alibaba\nacos\exception
 */
class RequestVerbRequiredException extends Exception
{
    /**
     * RequestVerbRequiredException constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}