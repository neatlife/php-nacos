<?php


namespace alibaba\nacos\exception;


use Exception;

/**
 * Class RequestUriRequiredException
 * @author suxiaolin
 * @package alibaba\nacos\exception
 */
class RequestUriRequiredException extends Exception
{
    /**
     * RequestUriRequiredException constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}