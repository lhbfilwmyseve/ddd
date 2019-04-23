<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/10
 * Time: 10:12
 * Email:498807233@qq.com
 */

namespace LockDoor\Auth\HoneyComb;


use LockDoor\Auth\Auth;
use LockDoor\LockDoor;
use LockDoor\Request\LockDoorRequest;
use LockDoor\Token\HoneyComb\HoneCombIOTToken as Token;

class HoneyCombIOTAuth extends Auth
{
    use LockDoor, LockDoorRequest;

    public $appId = '';

    public $appSecret = '';

    public $salt = '';

    public $timestamp;

    public $sign;

    public $token;

    function __construct()
    {
        $this->timestamp = time();
        $this->setSalt();
        $this->makeSecret();
        $this->makeSign();
    }

    public function setSalt()
    {
        $this->salt = md5(uniqid(microtime(true), true));
        return $this;
    }

    public function makeSign()
    {
        $arr = [
            'appId' => $this->appId,
            'salt' => $this->salt,
            'timestamp' => $this->timestamp
        ];
        ksort($arr);
        $arrData = sha1(json_encode($arr));
        $this->sign = $this->String2Hex($this->make($this->Hex2String($arrData)));
    }

    public function makeSecret()
    {
        $this->secret = $this->Hex2String(substr(sha1($this->appSecret), 0, 32));
    }

    /**
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __invoke()
    {
        $base_uri = 'https://www.fengchaoiot.com';
        $uri = '/api/accessToken';
        $bodyArr = [
            'appId' => $this->appId,
            'salt' => $this->salt,
            'timestamp' => $this->timestamp,
            'sign' => $this->sign
        ];
        $params['headers'] = [
            'Content-Type' => 'application/json',
            'X-Accept-Version' => 'beehive.v1'
        ];
        $params['body'] = json_encode($bodyArr);
        $params['debug'] = false;
        $params['http_errors'] = true;
        $response = $this->request($base_uri, $uri, $params);
        if ($response->getStatusCode() == 200) {
            $responseContent = $response->getBody()->getContents();
            $responseArr = json_decode($responseContent, true);
            if (isset($responseArr['code']) || $responseArr['code'] == 0) {
                $tokenData = $responseArr['data'];
                $tokenData['timestamp'] = $this->timestamp;
                $this->token = new Token();
                $this->token->setToken(json_encode($tokenData));
            }
        }
        return $response;
    }
}