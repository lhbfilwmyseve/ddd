<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/11
 * Time: 14:49
 * Email:498807233@qq.com
 */

namespace LockDoor\Token\HoneyComb;


use LockDoor\Auth\HoneyComb\HoneyCombIOTAuth;
use LockDoor\Token\Token;

/**
 * 获取本地存得蜂巢TOKEN
 * Class HoneCombIOTToken
 * @package LockDoor\Token\HoneyComb
 */
class HoneCombIOTToken extends Token
{
    public $accessToken = 'accessToken';

    public $expiresIn = 'expiresIn';

    public $appId = '';

    public $appSecret = '';

    public function __construct($appId, $appSecret, $file = TOKEN_FILE)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        parent::__construct($file);
    }

    /**
     * @param bool $test
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken($test = false)
    {
        $tokenArr = parent::getToken();
        $tokenKeys = array_keys($tokenArr);
        if (!in_array($this->accessToken, $tokenKeys) || !in_array($this->expiresIn, $tokenKeys)) {
            return 'token is wrong';
        }
        if ($tokenArr['timestamp'] + $tokenArr['expiresIn'] <= time()) {
            $auth = new HoneyCombIOTAuth($this->appId, $this->appSecret);
            $response = $auth();
            if ($response->getStatusCode() == 200) {
                $token = json_decode($response->getBody()->getContents(), true);
                $tokenArr = $token['data'];
            }
        }
        if ($test == true) {
            return $tokenArr;
        }
        return $tokenArr[$this->accessToken];
    }
}