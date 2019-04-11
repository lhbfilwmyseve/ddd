<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 10:15
 * Email:498807233@qq.com
 */

namespace LockDoor\Device;

use LockDoor\Request\LockDoorRequest;

/**
 * 设备
 * Class Device
 * @package LockDoor\Device
 */
abstract class Device
{
    use LockDoorRequest;

    public $accessToken = '';


    abstract public function getToken();

    /**
     * 绑定设备
     * @param $secret
     * @param array $tags
     * @return mixed
     */
    abstract public function bind($secret = '', array $tags = []);

    /**
     * @param string $search
     * @param string $product
     * @param string $deviceId
     * @param array $tags
     * @return mixed
     */
    abstract public function get(string $search, string $product, string $deviceId, array $tags);

    /**
     *
     * 删除设备
     * @param array $deviceIds
     * @return mixed
     */
    abstract public function delete(array $deviceIds);
}