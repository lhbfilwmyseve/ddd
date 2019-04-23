<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/18
 * Time: 16:20
 * Email:498807233@qq.com
 */

namespace LockDoor\Device\HoneComb\Locks\NbLocks;


use LockDoor\device\HoneComb\Locks\HoneCombLocks;

class HoneCombNBLocks extends HoneCombLocks
{

    /**
     * 添加密码
     * @param $type
     * @param $password
     * @param $startTime
     * @param $endTime
     * @param $userId
     * @param $weeks
     * @return mixed
     */
    public function addPasswords($type, $password, $startTime, $endTime, $userId, array $weeks)
    {
        // TODO: Implement addPasswords() method.
    }

    /**
     * 添加卡片
     * @param $type
     * @param $cardNumber
     * @param $startTime
     * @param $endTime
     * @param $userId
     * @param $weeks
     * @return mixed
     */
    public function addCards($type, $cardNumber, $startTime, $endTime, $userId, array $weeks)
    {
        // TODO: Implement addCards() method.
    }

    /**
     * 添加指纹
     * @param $startTime
     * @param $endTime
     * @param int $userId
     * @param array $fingerprint
     * @return mixed
     */
    public function addFingers($startTime, $endTime, $userId = 0, array $fingerprint = [])
    {
        // TODO: Implement addFingers() method.
    }

    /**
     * 获取设备权限
     * @param $operate
     * @param $userId
     * @param $authId
     * @return mixed
     */
    public function authorities($operate, $userId = '', $authId = '')
    {
        // TODO: Implement authorities() method.
    }
}