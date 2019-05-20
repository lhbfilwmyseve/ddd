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


    abstract public function getToken($token);

    /**
     * 绑定设备
     * @param string $name
     * @param string $secret
     * @param array $tags
     * @return mixed
     */
    abstract public function bind($name = '', $secret = '', array $tags = []);

    /**
     * @param array $options
     * @param string $search
     * @param string $product
     * @param string $deviceId
     * @param array $tags
     * @return mixed
     */
    abstract public function get(array $options = [], string $search = '', string $product = '', string $deviceId = '', array $tags = []);

    /**
     *
     * 删除设备
     * @param array $deviceIds
     * @return mixed
     */
    abstract public function delete(array $deviceIds);

    /**
     * save方法 设备信息存储 不同厂商不同设备不同框架需要不同实现
     * @param $name
     * @param mixed ...$params
     * @return mixed
     */
    public function save($name,...$params){
        return call_user_func_array($name,$params);
    }
}