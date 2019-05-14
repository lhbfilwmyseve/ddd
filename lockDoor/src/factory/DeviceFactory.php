<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/5/14
 * Time: 15:52
 * Email:498807233@qq.com
 */

namespace LockDoor\factory;


/**
 *
 * @method static \EasyWeChat\Payment\Application            payment(array $config)
 * @method static \EasyWeChat\MiniProgram\Application        miniProgram(array $config)
 * @method static \EasyWeChat\OpenPlatform\Application       openPlatform(array $config)
 * @method static \EasyWeChat\OfficialAccount\Application    officialAccount(array $config)
 * @method static \EasyWeChat\BasicService\Application       basicService(array $config)
 * @method static \EasyWeChat\Work\Application               work(array $config)
 * @method static \EasyWeChat\OpenWork\Application           openWork(array $config)
 * Class DeviceFactory
 * @package LockDoor\factory
 */
class DeviceFactory
{
    public static function __callStatic($name, $method, array $params = [])
    {
        return call_user_func_array([$name, $method], $params);
    }
}