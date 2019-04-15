<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/15
 * Time: 14:57
 * Email:498807233@qq.com
 */

namespace LockDoor\device\HoneComb\locks;


use LockDoor\device\HoneComb\HoneCombIOTDevice;

abstract class HoneCombLocks extends HoneCombIOTDevice
{
    public $deviceId;

    public function __construct($deviceID)
    {
        parent::__construct();
        $this->deviceId = $deviceID;
    }

    /**
     * 获取门锁密码
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLocksPasswords()
    {
        $this->uri = '/locks/' . $this->deviceId . '/passwords';
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        return $this->request($this->baseUri, $this->uri, $requestParams, 'GET');
    }

    /**
     * 获取门锁卡片列表
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLocksCards()
    {
        $this->uri = '/locks/' . $this->deviceId . '/cards';
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        return $this->request($this->baseUri, $this->uri, $requestParams, 'GET');
    }

    /**
     * 获取门锁指纹列表
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLocksFingers()
    {
        $this->uri = '/locks/' . $this->deviceId . '/fingers';
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        return $this->request($this->baseUri, $this->uri, $requestParams, 'GET');
    }

    /**
     *  获取门锁离线临时密码
     * @param $type
     * @param $limitTime
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLocksTokens($type = '', $limitTime = '')
    {
        $this->uri = '/locks/' . $this->deviceId . '/tokens';
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $bodyArr = [];
        if ($type){
            $bodyArr['type'] = $type;
        }
        if ($limitTime){
            $bodyArr['endTime'] = $limitTime;
        }
        if ($type == 'TOKEN_OF_LIMIT' && !$limitTime){
            return '限时密码查询缺少截至时间';
        }
        $requestParams['body'] = json_encode(
            [
                'type' => $type,
                'endTIme' => $limitTime
            ]
        );
        return $this->request($this->baseUri, $this->uri, $requestParams);
    }

    /**
     * 添加密码
     * @return mixed
     */
    abstract public function addPasswords();

    /**
     * 添加卡片
     * @return mixed
     */
    abstract public function addCards();

    /**
     * 添加指纹
     * @return mixed
     */
    abstract public function addFingers();
}