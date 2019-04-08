<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 14:42
 * Email:498807233@qq.com
 */

namespace LockDoor\Device;


class DeviceTags extends ADevice
{
    public $deviceId;

    public $url;

    function __construct($deviceId)
    {
        parent::__construct();
        $this->deviceId = $deviceId;
        $this->url = BASE_URL . 'devices/' . $this->deviceId . '/tags';
    }

    /**
     * 更新设备标签
     * @param array $tags
     * @return array
     */
    public function updateDeviceTags( array $tags){
        return request($this->url,$tags);
    }

    /**
     * 删除设备分组标签
     * @param array $tags
     * @return array
     */
    public function deleteDeviceTags(array $tags){
        $method = 'DELETE';
        return request($this->url,$tags,$method);
    }
}