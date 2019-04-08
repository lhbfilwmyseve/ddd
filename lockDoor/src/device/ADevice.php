<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 10:15
 * Email:498807233@qq.com
 */

use LockDoor\Auth\Auth;

abstract class ADevice
{
    private $accessToken;

    private $expiresIn;

    private $url = BASE_URL.'devices';

    public $deviceType = 'MU6610-BC-A';

    function __construct()
    {
        $this->isAccess();
    }

    abstract public function getDeviceType();

    private function isAccess()
    {
        $auth = new Auth();
        $accessArr = $auth();
        if (!is_array($accessArr)) {
            return 'access failed';
        }
        if (array_diff(['accessToken', 'expiresIn'], $accessArr)) {
            return 'access failed';
        }
        $this->accessToken = $accessArr['accessToken'];
        $this->expiresIn = $accessArr['expiresIn'];
        return $this;
    }

    /**
     * 添加设备
     * @param $secret
     * @param array $tags
     * @return array
     */
    public function bind($secret,$tags = [])
    {
        $method = 'POST';
        $params = [
            'name'=>$this->deviceType,
            'secret'=>$secret,
            'tags'=>$tags
        ];
      return  request($this->url,$params,$method);
    }



    public function get($search,$product,$tags,$deviceId){

    }
}