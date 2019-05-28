<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/5/14
 * Time: 16:33
 * Email:498807233@qq.com
 */

namespace LockDoorTest;

use LockDoor\factory\device\BeautyHeartDevice;
use PHPUnit\Framework\TestCase;

class BeautyHeartDeviceTest extends TestCase
{
    public $beautyHeart;

    function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $deviceStr = '{"Mac": "18:93:D7:01:CB:D9", "Name": "dyGJPXAcvZAWBBBA", "Index": "0", "OpenPwd": "186571", "Locktime": "20180419162444", "OpenPwdKey": "C4912E76D4479F7B91CE110826"}';
//        $deviceStr = '{"OpenPwdKey":"78209BE95BA6E78027B36876B7","Index":"0","Mac":"18:93:D7:01:98:E0","Name":"dyGJPXAZjgAWBBBA","OpenPwd":"622497","Locktime":"19700101002048"}';
//        $deviceStr = '{"Mac": "04:A3:16:5F:0E:77", "Name": "dyBKMWXw53AWBBAA", "Index": "0", "OpenPwd": "065742", "Locktime": "20180517130130", "OpenPwdKey": "079B8A737AA3B156819EAB5265"}';
        $this->beautyHeart = new BeautyHeartDevice('047dfb2bf3294130bb61509523927289',json_decode($deviceStr,true));
        parent::__construct($name, $data, $dataName);
    }

    public function testOpen()
    {
        $res = $this->beautyHeart->open();
        var_export("\n====================\n");
        var_export($res);
        var_export("\n====================\n");
        $this->assertEquals(200,$res['code']);
        $this->assertArrayHasKey('password',$res['data'],'存在错误');
    }
}
