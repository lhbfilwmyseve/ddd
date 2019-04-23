<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/22
 * Time: 15:52
 * Email:498807233@qq.com
 */

namespace LockDoorTest;

use LockDoor\device\HoneComb\Locks\BlueLocks\HoneCombBlueLocks;
use PHPUnit\Framework\TestCase;

class HoneCombBlueLocksTest extends TestCase
{
    public $blueLocks;

    /**
     * HoneCombBlueLocksTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->blueLocks = new HoneCombBlueLocks('5caf0a947625f500014c63e9');
        parent::__construct($name, $data, $dataName);
    }

    public function testAddFingers()
    {

    }

    public function test__construct()
    {

    }

    public function testOpenLockDoor()
    {
        /**
         * {"code":0,"msg":"成功","data":{"command":"3QEBEHXY17rABNdEeXLiJYwb+Q4="}}
         */
       $res = $this->blueLocks->openLockDoor(12);
       echo PHP_EOL;
       echo $res->getBody()->getContents();
       echo PHP_EOL;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testAddPasswords()
    {
        $type = 'PLAIN';
        $password = '36985214';
        $startTime = date('Y-m-d H:i:s',time());
        $endTime = date('Y-m-d H:i:s',time()+60);
        $userId = 20;
        $weeks = [];
        /** @var TYPE_NAME $startTime */
        /** @var TYPE_NAME $startTime */
        $res = $this->blueLocks->addPasswords($type,$password,$startTime,$endTime,$userId,$weeks);
        echo PHP_EOL;
        echo $res->getBody()->getContents();
        echo PHP_EOL;
    }

    public function testAuthorities()
    {

    }

    public function testUploadBlueRes()
    {

    }

    public function testSyncEvents()
    {

    }

    public function testSetting()
    {

    }

    public function testSyncTime()
    {

    }

    public function testAddCards()
    {

    }

    public function testUploadEvents()
    {

    }
}
