<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/12
 * Time: 14:10
 * Email:498807233@qq.com
 */

namespace LockDoorTest;

use LockDoor\device\HoneComb\HoneCombIOTDevice;
use PHPUnit\Framework\TestCase;

class HoneCombIOTDeviceTest extends TestCase
{

    public $device;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->device = new HoneCombIOTDevice();
        parent::__construct($name, $data, $dataName);
    }

    public function test__construct()
    {
        $this->assertNotEmpty($this->device->authorization);
//        $this->assertArrayHasKey('Authorization', $this->device->authorization);
    }
//    public function testGetToken()
//    {
//        $this->assertIsString($this->device->accessToken, 'accessToken不存在');
//    }



    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
//    public function testGet()
//    {
//        /**
//         * $deviceContent
//         * {
//         * "code": 0,
//         * "msg": "成功",
//         * "data": {
//         * "content": [
//         * {
//         * "deviceId": "5caf0a817625f500014c63e8",
//         * "name": "003A004A5353510D20393035",
//         * "secret": "123456",
//         * "createdAt": "2019-04-11 17:36:01",
//         * "product": "MU6610_BC_K",
//         * "version": "V1.08修改后加蜂鸣器",
//         * "productStatus": "STABLE",
//         * "tags": [],
//         * "sysTags": [],
//         * "bluetoothMac": "A5B3C292011D",
//         * "batchId": "5caf0a5c7625f500014c63e7"
//         * }
//         * ],
//         * "totalPages": 1,
//         * "totalElements": 1,
//         * "pageSize": 50,
//         * "offset": 0,
//         * "pageNumber": 0
//         * }
//         * }
//         */
//        $deviceID = '003A004A5353510D20393035';
//        $deviceContent = $this->device->get([], $deviceID);
//        $this->assertEquals(200, $deviceContent);
//    }

//    public function testDelete()
//    {
//
//    }
//
//    public function testBind()
//    {
//
//    }
}
