<?php


namespace LockDoor\card;


use Exception;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 卡片类参数描述
 * Class Cards
 * @documentlink  https://www.yuque.com/docs/share/81911a0d-5640-47c6-80df-988a05267d60#3f59f318
 * @package LockDoor\card
 * @property false|string cardId 卡号 HEX编码字符串格式
 * @property false|string cardType 卡类型。类型如下：@value
 * * * * * * * * * * * * * * * * * * * * * * guest(宾客卡),
 * * * * * * * * * * * * * * * * * * * * * * master(总卡),
 * * * * * * * * * * * * * * * * * * * * * * floor(楼层卡),
 * * * * * * * * * * * * * * * * * * * * * * building(楼栋卡),
 * * * * * * * * * * * * * * * * * * * * * * elevator(电梯卡),
 * * * * * * * * * * * * * * * * * * * * * * emergency(应急卡),
 * * * * * * * * * * * * * * * * * * * * * * reserve(备用卡),
 * * * * * * * * * * * * * * * * * * * * * * authorization(授权卡),
 * * * * * * * * * * * * * * * * * * * * * * reportLoss(挂失卡),
 * * * * * * * * * * * * * * * * * * * * * * network(入网卡),
 * * * * * * * * * * * * * * * * * * * * * * clearNet(清网卡),
 * * * * * * * * * * * * * * * * * * * * * * install(安装卡),
 * * * * * * * * * * * * * * * * * * * * * * checkTime(较时卡),
 * * * * * * * * * * * * * * * * * * * * * * lockSetting(锁体设置卡),
 * * * * * * * * * * * * * * * * * * * * * * clearRoomNum(清号卡),
 * * * * * * * * * * * * * * * * * * * * * * checkOut(退房卡),
 * * * * * * * * * * * * * * * * * * * * * * multiDoor(多门卡),
 * * * * * * * * * * * * * * * * * * * * * * data(数据卡),
 * * * * * * * * * * * * * * * * * * * * * * areaSetting(区域设置卡),
 * * * * * * * * * * * * * * * * * * * * * * init(初始卡);
 * @property false|string hotelId 酒店ID，数字。最大值4294967295
 * @property false|string startTime 开始时间。除了挂失卡、区域设置卡、安装卡外必选。格式：“YYYY-MM-DD H:m:s”。
 * @property false|string endTime 结束时间。同开始时间。
 * @property false|array weeks 周次，字符串数组格式[] @value MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY,SUNDAY
 * @property false|int useCount  使用次数,小于等于0为否，大于0为是。
 * @property false|string mark json字符串 @class Mark @method getMark()
 * @property false|int building 楼栋号，数字
 * @property false|int floor 楼层号，数字
 * @property false|int lockArea 锁区，1～8数字
 * @property false|int roomNum 房号，数字
 * @property false|int suitNum 套间，数字
 * @property false|array cardArea 卡区
 * @property false|int replaceNum 替换号
 * @property false|array authorities 权限列表。数组格式，最大五个楼栋号或楼层号。
 * @property false|string authOfCardId 卡号权限。HEX编码格式
 * @property false|int lockCardOrDoor 封卡或封门
 * @property false|string lockType 门锁类型
 * @property false|int startHour1 时段1，开始小时
 * @property false|int endHour1 时段1，结束小时
 * @property false|int startHour2 时段2，开始小时
 * @property false|int endHour2 时段2，结束小时
 * @property false|int startHour3 时段3，开始小时
 * @property false|int endHour3 时段3，结束小时
 */
class Cards extends ICards
{

    /**
     * @var string
     */
    private $accessToken;
    private $authorization;
    function __construct($token)
    {
        $this->getToken($token);
    }

    public function getToken($token)
    {
        $tokenString = '';
        if (is_object($token)) {
            $tokenString = $token->getToken();
        }
        if (is_string($token)) {
            $tokenString = $token;
        }
        if (is_array($token)) {
            if (isset($token['token'])) {
                $tokenString = $token['token'];
            }
        }
        $this->accessToken = $tokenString;
        $this->authorization = [
            'Authorization' => 'Bearer ' . $this->accessToken
        ];
    }

    /**
     * @param int $time
     */
    public function setStartTime(int $time)
    {
        $this->startTime = date('Y-m-d H:i:s', $time);
    }

    /**
     * @param int $time
     */
    public function setEndTime(int $time)
    {
        $this->endTime = date('Y-m-d H:i:s', $time);
    }

    /**
     * @param $name
     * @param $value
     */
    function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     *制卡接口
     * @throws GuzzleException
     * @throws Exception
     */
    public function make()
    {
        $request['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $request['form_params'] = $this->toArray();
        $response = $this->request(BASE_URL, '/hotelCards', $request);
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            throw new Exception('制卡请求错误');
        }
    }

    /**
     * 读卡接口
     * @throws GuzzleException
     * @throws Exception
     */
    public function read()
    {
        $request['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $request['form_params'] = $this->toArray();
        $response = $this->request(BASE_URL, '/hotelCards/read', $request);
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            throw new Exception('读卡请求错误');
        }
    }

    /**
     * 转为数组
     * @throws Exception
     */
    public function toArray()
    {
        $require = [
            'cardId',
            'cardType',
            'hotelId',
        ];
        $filters = [
            'cardId',
            'cardType',
            'hotelId',
            'startTime',
            'endTime',
            'weeks',
            'useCount',
            'mark',
            'building',
            'floor',
            'lockArea',
            'roomNum',
            'suitNum',
            'cardArea',
            'replaceNum',
            'authorities',
            'authOfCardId',
            'lockCardOrDoor',
            'lockType',
            'startHour1',
            'startHour2',
            'startHour2',
            'endHour2',
            'startHour3',
            'endHour3'
        ];
        $arr = [];
        foreach ($this as $key => $v) {
            if (property_exists($this, $v) && in_array($v, $filters)) {
                $arr[$v] = $this->$v;
            }
        }
        $columns = array_keys($arr);
        foreach ($require as $item) {
            if (!in_array($item, $columns)) {
                throw new Exception($item . 'is require');
            }
        }
        return $arr;
    }
}