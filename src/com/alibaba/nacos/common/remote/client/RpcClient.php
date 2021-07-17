<?php

namespace com\alibaba\nacos\common\remote\client;

use com\alibaba\nacos\api\grpc\auto\BiRequestStreamClient;
use com\alibaba\nacos\api\grpc\auto\Metadata;
use com\alibaba\nacos\api\grpc\auto\Payload;
use com\alibaba\nacos\api\grpc\auto\RequestClient;
use com\alibaba\nacos\api\utils\NetUtils;
use com\alibaba\nacos\client\config\impl\ServerListManager;
use Google\Protobuf\Any;
use Grpc\Channel;
use Grpc\ChannelCredentials;

class RpcClient
{

    private $serverListManager = null;

    private $channel = null;

    /**
     * RpcClient constructor.
     */
    public function __construct(array $properties, ServerListManager $serverListMgr)
    {
        $this->serverListManager = $serverListMgr;
        $cred = ChannelCredentials::createInsecure();

        $hostname = $this->serverListManager->genNextServer();
        $this->channel = new Channel($hostname, ['credentials' => $cred]);

        $client = new RequestClient($hostname, ['credentials' => $cred], $this->channel);

        $newMeta = new Metadata();
        $newMeta->setClientIp(NetUtils::localIP());
        $newMeta->setType("ServerCheckRequest");
        $newMeta->setHeaders([
            'charset' => 'UTF-8',
            "exConfigInfo" => "true",
        ]);

        $jsonBody = "{\"headers\":{},\"module\":\"internal\"}";
        $req = new Payload();
        $req->setMetadata($newMeta);
        $body = new Any();
        $body->setValue($jsonBody);
        $req->setBody($body);

        /**
         * @type $reply Payload
         */
        list($reply, $status) = $client->request($req)->wait();

        $resAny = $reply->getBody();
        // TODO 检查服务器状态
        //var_dump($resAny->getValue());
    }

    public function start()
    {
        $cred = ChannelCredentials::createInsecure();

        $hostname = $this->serverListManager->genNextServer();

        $client = new BiRequestStreamClient($hostname, ['credentials' => $cred], $this->channel);

        $newMeta = new Metadata();
        $newMeta->setClientIp(NetUtils::localIP());
        $newMeta->setType("ConnectionSetupRequest");
        $newMeta->setHeaders([
            'charset' => 'UTF-8',
            "exConfigInfo" => "true",
        ]);

        $jsonArr = [
            'headers' => ['test' => 'test'],
            'abilities' => [
                'remoteAbility' => [
                    'supportRemoteConnection' => true,
                ],
            ],
            'tenant' => '',
            'labels' => [
                'module' => 'config',
                'source' => 'sdk',
                'taskId' => '0',
                'AppName' => 'unknown'
            ],
            'module' => 'internal',
        ];
        $jsonArr['clientVersion'] = 'Nacos-PHP-Client:v1.0.0';
        $jsonBody = json_encode($jsonArr);
        $req = new Payload();
        $req->setMetadata($newMeta);
        $body = new Any();
        $body->setValue($jsonBody);
        $req->setBody($body);

        $call = $client->requestBiStream();
        $call->write($req);
        $call->writesDone();
        //wait to register connection setup
        usleep(750);
    }

    public function queryConfig(string $dataId, string $group, string $tenant, int $readTimeout,
                                bool $notify): string
    {
        $cred = ChannelCredentials::createInsecure();
        $hostname = $this->serverListManager->genNextServer();

        $client = new RequestClient($hostname, ['credentials' => $cred], $this->channel);

        $newMeta = new Metadata();
        $newMeta->setClientIp(NetUtils::localIP());
        $newMeta->setType("ConfigQueryRequest");
        $newMeta->setHeaders([
            'charset' => 'UTF-8',
            "exConfigInfo" => "true",
        ]);

        $jsonArr = [
            'headers' => ['test' => 'test'],
            'dataId' => $dataId,
            'group' => $group,
            'tenant' => $tenant,
            'notify' => $notify,
            'module' => 'config',
        ];
        $req = new Payload();
        $req->setMetadata($newMeta);
        $body = new Any();
        $body->setValue(json_encode($jsonArr));
        $req->setBody($body);

        /**
         * @type $reply Payload
         */
        list($reply, $status) = $client->request($req)->wait();

        $resAny = $reply->getBody();
        $value = $resAny->getValue();
        return $value;
    }

    public function publishConfig(string $dataId, string $group, string $tenant, string $content): string
    {
        $cred = ChannelCredentials::createInsecure();
        $hostname = $this->serverListManager->genNextServer();

        $client = new RequestClient($hostname, ['credentials' => $cred], $this->channel);

        $newMeta = new Metadata();
        $newMeta->setClientIp(NetUtils::localIP());
        $newMeta->setType('ConfigPublishRequest');
        $newMeta->setHeaders([
            'charset' => 'UTF-8',
            "exConfigInfo" => "true",
        ]);

        $jsonArr = [
            'headers' => ['test' => 'test'],
            'dataId' => $dataId,
            'group' => $group,
            'tenant' => $tenant,
            'content' => $content,
            'module' => 'config',
        ];

        $req = new Payload();
        $req->setMetadata($newMeta);
        $body = new Any();
        $body->setValue(json_encode($jsonArr));
        $req->setBody($body);

        /**
         * @type $reply Payload
         */
        list($reply, $status) = $client->request($req)->wait();

        $resAny = $reply->getBody();
        $value = $resAny->getValue();
        return $value;
    }
}
