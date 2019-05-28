<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/5/15
 * Time: 17:20
 * Email:498807233@qq.com
 */

namespace LockDoorTest\old;

use LockDoor\device\HoneComb\oldLocks\HoneyCombOldLockDevice;
use PHPUnit\Framework\TestCase;

class HoneyCombOldLockDeviceTest extends TestCase
{

    public $oldLock;

    function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->oldLock = new HoneyCombOldLockDevice('rDMscjKqQla5', 'EI1kbOoJnz1QY72kHjNzrH5sULWlWA41fQTYMAyId3gHqsrdlD');
        parent::__construct($name, $data, $dataName);
    }

    /*   public function testMakeSign()
       {

       }*/

   public function testSyncTime()
    {
        $response = $this->oldLock->syncTime('304511F96966','255','246');
        var_export("\n==========================================================\n");
        var_export($response->getBody()->getContents());
        var_export("\n==========================================================\n");

    }

/*    public function testDeleteLocks()
    {

    }*/

//    public function testGetEvents()
//    {
//        $response = $this->oldLock->getEvents('304511F96966','255','246','MANAGER');
////        {"packets":["BgYaw8IoLIfzc45ZxgAGBgYGBgY="]}
//        var_export("\n==========================================================\n");
//        var_export($response->getBody()->getContents());
//        var_export("\n==========================================================\n");
//    }
/*
    public function test__construct()
    {

    }*/

 /*   public function testUpdateLocks()
    {

    }*/

/*    public function testAddNewLocks()
    {

    }*/


    /**
     * 获取门锁列表
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
/*    public function testGetLocksList()
    {
//        $response = $this->oldLock->getLocksList('246','322');
//        $responseStr = $response->getBody()->getContents();
//        //$responseStr  [{"created_at":"2018-12-7 14:38:37","updated_at":"2018-12-7 14:38:37","lockId":"304511F96966","hotelId":"246","roomId":"322","remark":"1003"}]
//        var_export("\n================================\n");
//        var_export($response->getBody()->getContents());
//        var_export("\n================================\n");
    }*/

  /*  public function testDeleteUserPermissions()
    {

    }*/

    /**
     * 向门锁里面添加用户权限
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
/*    public function testAddUserPermissions()
    {
        $time = time();
        $startTime = date('Y-m-d H:i:s',$time);
        $endTime = date('Y-m-d H:i:s',strtotime('+1 day',$time));
        $response = $this->oldLock->addUserPermissions('304511F96966','256','246',$startTime,$endTime,'MANAGER');
//        ''{"created_at":"2019-5-15 10:00:21","updated_at":"2019-5-15 10:00:38","lockId":"304511F96966","userId":"255","hotelId":"246","type":"TENANT","startTime":"2019-05-15T18:00:38.000Z","endTime":"2019-05-16T18:00:38.000Z"}''
        var_export("\n======================\n");
        var_export($response->getBody()->getContents());
        var_export("\n======================\n");

    }*/
}
