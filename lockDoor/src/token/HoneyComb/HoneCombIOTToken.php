<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/11
 * Time: 14:49
 * Email:498807233@qq.com
 */

namespace LockDoor\Token\HoneyComb;


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

    public function getToken($test = false)
    {
        $tokenArr = parent::getToken();
        $tokenKeys = array_keys($tokenArr);
        if (!in_array($this->accessToken, $tokenKeys) || !in_array($this->expiresIn, $tokenKeys)) {
            return 'token is wrong';
        }
        if ($test == true) {
            return $tokenArr;
        }
        if ($tokenArr['timestamp'] + $tokenArr['expiresIn'] >= time()) {
            return 'token was expired';
        }
        return $tokenArr[$this->accessToken];
    }
}