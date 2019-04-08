<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 9:45
 * Email:498807233@qq.com
 */

namespace LockDoor\Request;


interface ILockDoorRequest
{
    const BASE_URL = 'https://api.fengchaoiot.com/';
    public function request($url,$params = []);
}