<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 15:41
 * Email:498807233@qq.com
 */

namespace LockDoor\Device;


class DeviceCommands extends ADevice
{

    public $deviceId;

    public $url;

    function __construct($deviceId)
    {
        parent::__construct();
        $this->deviceId = $deviceId;
        $this->url = BASE_URL . 'devices/' . $this->deviceId . '/commands';
    }

    /**
     * 发送命令
     * @param $cmdId
     * @param $status
     * @return array
     */
    public function sendCommands($cmdId,$status){
        $params = [
            'cmdId'=>$cmdId,
            'status'=>$status
        ];
        return request($this->url,$params);
    }
}