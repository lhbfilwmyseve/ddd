<?php

namespace LockDoor\Auth;


use LockDoor\LockDoor;

class Authority implements Auth
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
        $data = sha1(json_encode(['appId' => self::APPID, 'salt' => self::SALT]));
        $this->sign = $this->pkcs5(openssl_encrypt($data, self::METHOD, $this->key));

    }

    public function getKey()
    {
        $this->key = substr(sha1(self::APPSECRET), 0, 16);
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}