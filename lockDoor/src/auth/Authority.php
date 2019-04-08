<?php

namespace LockDoor\Auth;


use LockDoor\LockDoor;

class Authority implements IAuth
{
    use LockDoor;

    private $authUrl;

    private $key;

    private $sign;

    private static $instance;

    function __construct()
    {
        $this->makeSign();
    }

    public function makeSign()
    {
        $this->key = $this->getKey();
        $data = sha1(json_encode(['appId' => self::APP_ID, 'salt' => self::SALT]));
        $this->sign = $this->pkcs5(openssl_encrypt($data, self::METHOD, $this->key));
    }

    public function getKey()
    {
        $this->key = substr(sha1(self::APP_SECRET), 0, 16);
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getAuthorityData(){
        return [
            'appid'=>self::APP_ID,
            'salt'=>self::SALT,
            'sign'=>$this->sign
        ];
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}