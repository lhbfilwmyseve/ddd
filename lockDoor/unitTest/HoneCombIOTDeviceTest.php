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

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        $this->device = new HoneCombIOTDevice();
        parent::__construct($name, $data, $dataName);
    }

    public function test__construct()
    {
        $this->assertNotEmpty($this->device->authorization);
        $this->assertArrayHasKey('Authorization', $this->device->authorization);
    }

    public function testGetToken()
    {
        $this->assertIsString($this->device->accessToken, 'accessToken不存在');
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGet()
    {
        /**
         * $deviceContent
         * {
         * "code": 0,
         * "msg": "成功",
         * "data": {
         * "content": [
         * {
         * "deviceId": "5caf0a817625f500014c63e8",
         * "name": "003A004A5353510D20393035",
         * "secret": "123456",
         * "createdAt": "2019-04-11 17:36:01",
         * "product": "MU6610_BC_K",
         * "version": "V1.08修改后加蜂鸣器",
         * "productStatus": "STABLE",
         * "tags": [],
         * "sysTags": [],
         * "bluetoothMac": "A5B3C292011D",
         * "batchId": "5caf0a5c7625f500014c63e7"
         * }
         * ],
         * "totalPages": 1,
         * "totalElements": 1,
         * "pageSize": 50,
         * "offset": 0,
         * "pageNumber": 0
         * }
         * }
         */
//        $deviceID = '003A004A5353510D20393035';
        $deviceID = '';
        $deviceContent = $this->device->get();
        $this->assertEquals(200, $deviceContent->getStatusCode());
        $jsonString = $deviceContent->getBody()->getContents();
        var_export("\n==============================================================================================\n");
        var_export('get response'.$jsonString);
        var_export("\n==============================================================================================\n");
        $deviceInfos = json_decode($jsonString, true);
        $this->assertArrayHasKey('code', $deviceInfos);
        $this->assertArrayHasKey('data', $deviceInfos);
        $this->assertEquals(0, $deviceInfos['code']);
        return $deviceInfos;
    }

    /**
     * @depends testGet
     * @param array $deviceInfos
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testDelete(array $deviceInfos)
    {

        /**
         * deleteMsg
         * {"code":0,"msg":"成功"}
         */
        $deviceIds = array_column($deviceInfos['data']['content'], 'deviceId');
        $response = $this->device->delete($deviceIds);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getBody()->getContents());
        var_export("\n==============================================================================================\n");
        var_export('delete  '.$response->getBody()->getContents());
        var_export("\n==============================================================================================\n");
        $contentsArr = json_decode($response->getBody()->getContents(), true);
        $this->assertArrayHasKey('code', $contentsArr);
        $this->assertArrayHasKey('msg', $contentsArr);
        $this->assertArrayNotHasKey('data', $contentsArr);
        $this->assertEquals(0, $contentsArr['code']);
        $this->assertEquals('成功', $contentsArr['msg']);
    }



    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testBind()
    {

        /**
         * $deviceSecretString = 'name|secret';
         */

        $deviceArr = [
            '0028004A5353510D20393035|A5B3C2950117',
            '0026004A5353510D20393035|A5B3C2930114',
            '003A004A5353510D20393035|A5B3C292011D'
        ];

        $tags = [
            "room_name:1001",
            "room_type:big",
            "room_id:201"
        ];
        $name = '0026004A5353510D20393035';
        $secret = 'A5B3C2930114';
        $bindResponse = $this->device->bind($name, $secret, $tags);
        echo PHP_EOL;
        var_dump($bindResponse);
        echo PHP_EOL;
        $this->assertEquals(200, $bindResponse->getStatusCode());
        var_export("\n==============================================================================================\n");
        var_export('bind response    ===='.$bindResponse->getBody()->getContents());
        var_export("\n==============================================================================================\n");

    }
}
