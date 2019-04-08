<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 15:06
 * Email:498807233@qq.com
 */

namespace LockDoor\Auth;


class Token
{
    private $file;

    function __construct()
    {
        $this->file = TOKEN_FILE;
    }

    public function getToken(){
        return file_get_contents($this->file);
    }

    /**
     * @param $data
     * @return bool|int
     * [
     *  "accessToken"=>:token,
     * 'expiresIn'=>:expiresIn,
     * 'outTime'=>:outTime //过期时间
     * ]
     */
    public function setToken($data){
        return file_put_contents($this->file,json_encode($data),LOCK_EX);
    }
}