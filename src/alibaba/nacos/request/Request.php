<?php

namespace alibaba\nacos\request;

use alibaba\nacos\enum\ErrorCodeEnum;
use alibaba\nacos\exception\RequestUriRequiredException;
use alibaba\nacos\exception\RequestVerbRequiredException;
use alibaba\nacos\exception\ResponseCodeErrorException;
use alibaba\nacos\NacosConfig;
use alibaba\nacos\util\HttpUtil;
use Psr\Http\Message\ResponseInterface;
use ReflectionException;

/**
 * Class Request
 * @author suxiaolin
 * @package alibaba\nacos\request
 */
abstract class Request
{
    /**
     * 接口地址
     * @var
     */
    protected $uri;

    /**
     * 接口动词
     * @var
     */
    protected $verb;

    /**
     * 忽略这些属性
     *
     * @var array
     */
    protected $standaloneParameterList = ["uri", "verb"];

    /**
     * 发起请求，做返回值异常检查
     *
     * @return mixed|ResponseInterface
     * @throws RequestUriRequiredException
     * @throws RequestVerbRequiredException
     * @throws ResponseCodeErrorException
     * @throws ReflectionException
     */
    public function doRequest()
    {
        list($parameterList, $headers) = $this->getParameterAndHeader();
        $response = HttpUtil::request(
            $this->getVerb(),
            $this->getUri(),
            $parameterList,
            $headers,
            ['debug' => NacosConfig::getIsDebug()]
        );

        if (isset(ErrorCodeEnum::getErrorCodeMap()[$response->getStatusCode()])) {
            throw new ResponseCodeErrorException($response->getStatusCode(), ErrorCodeEnum::getErrorCodeMap()[$response->getStatusCode()]);
        }
        return $response;
    }

    /**
     * 获取请求参数和请求头
     * @return array
     * @throws ReflectionException
     */
    abstract protected function getParameterAndHeader();

    /**
     * @return mixed
     * @throws
     */
    public function getVerb()
    {
        if ($this->verb == null) {
            throw new RequestVerbRequiredException();
        }
        return $this->verb;
    }

    /**
     * @param mixed $verb
     */
    public function setVerb($verb)
    {
        $this->verb = $verb;
    }

    /**
     * @return mixed
     * @throws
     */
    public function getUri()
    {
        if ($this->uri == null) {
            throw new RequestUriRequiredException();
        }
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

}