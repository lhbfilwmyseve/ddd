<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/30
 * Time: 10:37
 * Email:498807233@qq.com
 */

namespace LockDoor\token;


class TokenManager implements Token
{
    public $token;


    public function __construct(object $token)
    {
        $this->token = $token;
    }

    public function set($string)
    {
        return $this->token->set($string);
    }

    public function get($key = '')
    {
        return $this->token->get($key);
    }

    public function delete()
    {
        return $this->token->delete();
    }

    public function isVoid()
    {
        return $this->token->isVoid();
    }

    public function reload()
    {
        return $this->token->reload();
    }

}