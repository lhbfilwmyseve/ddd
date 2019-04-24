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

    public $tokenArr = [];

    public $auth;

    public function __construct(object $auth, $file = TOKEN_FILE)
    {
        $this->auth = $auth;
        parent::__construct($file);
    }

    /**
     * @param bool $test
     * @return mixed|string
     */
    public function getToken($test = false)
    {
        $this->tokenArr = parent::getToken();
        return $this->voidToken();
    }

    /**
     * 验证token是否过期
     * @return mixed
     */
    public function voidToken()
    {
        if (empty($this->tokenArr)) {
            return false;
        }
        if (!isset($this->tokenArr['accessToken']) || !isset($this->tokenArr['expiresIn']) || !isset($this->tokenArr['timestamp'])) {
            return false;
        }

        $now = time();
        //判断token 是否过期
        if ($this->tokenArr['expiresIn'] + $this->tokenArr['timestamp'] <= $now) {
            return $this->reloadToken();
        }
        return $this->tokenArr;
    }

    /**
     * 如果token 过期  使用是方法重载token
     * @return mixed
     */
    public function reloadToken()
    {
        $token = $this->auth->reload();
        $this->setToken($token);
        return $token;
    }
}