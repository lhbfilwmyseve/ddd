<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/10
 * Time: 9:59
 * Email:498807233@qq.com
 */

namespace LockDoor\Auth;


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
     * token验证失败后重新拉取token的实现
     * @return mixed
     */
    abstract function reload();
}