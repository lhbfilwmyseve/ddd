<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/10
 * Time: 9:59
 * Email:498807233@qq.com
 */

namespace LockDoor\auth;


abstract class Auth
{
    public $appId;

    public $appSecret;

    public $secret;

    public $method = 'AES-128-ECB';

    public $options = OPENSSL_RAW_DATA;

    public $iv = '';


    /**
     * 返回加密后得结果
     * @param $data
     * @return string
     */
    public function make($data)
    {
        return openssl_encrypt($data, $this->method, $this->secret, $this->options, $this->iv);
    }

    /**
     * 加密后得请求
     * @return mixed
     */
//    abstract function request();
}