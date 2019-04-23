<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 15:06
 * Email:498807233@qq.com
 */

namespace LockDoor\Token;


abstract class Token
{
    public $file;

    /**
     * 默认蜂巢token
     * Token constructor.
     * @param string $file
     */
    function __construct($file = TOKEN_FILE)
    {
        $this->file = $file;
    }

    /**
     * 返回token
     * @return mixed
     */
    public function getToken()
    {
        $jsonString = file_get_contents($this->file);
        return json_decode($jsonString, true);
    }

    /**
     * @param string $data
     * @return bool|int
     * [
     *  "accessToken"=>:token,
     * 'expiresIn'=>:expiresIn,
     * 'outTime'=>:outTime //过期时间
     * ]
     */
    public function setToken(string $data)
    {
        return file_put_contents($this->file, $data, LOCK_EX);
    }
}