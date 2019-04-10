<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/10
 * Time: 10:12
 * Email:498807233@qq.com
 */

namespace LockDoor\auth\HoneyComb;


use LockDoor\auth\Auth;
use LockDoor\LockDoor;
use LockDoor\Request\LockDoorRequest;

class HoneyCombIOTAuth extends Auth
{
    use LockDoor, LockDoorRequest;

    public $appId = '5ca5cf767625f500014c6186';

    public $appSecret = 'tbkd1m99bvoASfeOK5kmaWHyPoAYlHEh';

    public $salt = 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq';

    public $timestamp = 1554877124;

    public $sign;

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
        echo 'jsonData  '.json_encode($arr);
        echo PHP_EOL;
        echo 'arrData   '.$arrData;
        echo PHP_EOL;
        $this->sign = $this->String2Hex($this->make($this->Hex2String($arrData)));
        echo 'sign  '.$this->sign;
        echo PHP_EOL;
    }

    public function makeSecret()
    {
        $this->secret = $this->Hex2String(substr(sha1($this->appSecret), 0, 32));
        echo 'Secret    '.substr(sha1($this->appSecret), 0, 32);
        echo PHP_EOL;
    }

    /**
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __invoke()
    {
        echo '$time   '.$this->timestamp;
        echo PHP_EOL;
        echo 'secret   '.$this->secret;
        echo PHP_EOL;
        echo 'salt   '.$this->salt;
        echo PHP_EOL;
        echo 'sign   '.$this->sign;
        echo PHP_EOL;
        $base_uri = 'https://www.fengchaoiot.com';
        $uri = '/api/accessToken';
        $bodyArr = [
            'appId' => $this->appId,
            'salt' => $this->salt,
            'timestamp' => $this->timestamp,
            'sign' => $this->sign
        ];
        echo json_encode($bodyArr);
        echo "\n";
        $params['headers'] = [
            'Accept' => 'application/json',
            'X-Accept-Version' => 'beehive.v1'
        ];
//        $params['body'] = \GuzzleHttp\json_encode($bodyArr);
//        $params['debug'] = true;
//        $params['http_errors'] = false;
        $response = $this->request($base_uri, $uri, $bodyArr);
        return $response;
    }
}