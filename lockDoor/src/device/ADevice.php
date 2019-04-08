<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 10:15
 * Email:498807233@qq.com
 */

namespace LockDoor\Device;

use LockDoor\Auth\Auth;
use LockDoor\Auth\Token;

abstract class ADevice
{
    private $accessToken;

    private $outTime;

    public $url = BASE_URL . 'devices';

    public $deviceType = 'MU6610-BC-A';

   public function __construct()
    {
        $this->isAccess();
    }

    public function isAccess()
    {
        $token = new Token();
        $accessArr = json_decode($token->getToken(), true);
        if ($accessArr['outTime'] - 3 >= time()) {
            $auth = new Auth();
            $accessArr = $auth();
            if (!is_array($accessArr)) {
                return 'access failed';
            }
            if (array_diff(['accessToken', 'expiresIn'], $accessArr)) {
                return 'access failed';
            }
            $this->accessToken = $accessArr['accessToken'];
            $this->outTime = $accessArr['outTime'];
        }

        return $this;
    }

    /**
     * 添加设备
     * @param $secret
     * @param array $tags
     * @return array
     */
    public function bind($secret, $tags = [])
    {
        $method = 'POST';
        $params = [
            'name' => $this->deviceType,
            'secret' => $secret,
            'tags' => $tags
        ];
        return request($this->url, $params, $method);
    }


    /**
     * 查询设备
     * @param string $search
     * @param string $product
     * @param array $tags
     * @param string $deviceId
     * @return array
     */
    public function get($search = '', $product = '', $tags = [], $deviceId = '')
    {
        $method = 'GET';
        $params = [
            'search' => $search,
            'product' => $product,
            'tags' => $tags,
            'deviceId' => $deviceId
        ];
        return request($this->url, $params, $method);
    }


    /**
     * 解绑设备
     * @param $deviceIds
     * @return array ['code'=>0,'msg'=>"成功"]
     */
    public function delete($deviceIds)
    {
        $method = 'DELETE';
        return request($this->url, $deviceIds, $method);
    }

}