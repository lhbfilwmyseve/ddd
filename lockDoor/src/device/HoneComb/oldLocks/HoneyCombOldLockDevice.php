<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/5/15
 * Time: 10:08
 * Email:498807233@qq.com
 */

namespace LockDoor\device\HoneComb\oldLocks;


use LockDoor\LockDoor;
use LockDoor\Request\LockDoorRequest;

class HoneyCombOldLockDevice
{
    use LockDoor, LockDoorRequest;
    private $appKey;
    private $appSecret;
    private $timestamp;
    private $url = 'http://lease.yunsuowang.com';

    function __construct($appKey, $appSecret)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->timestamp = time();
    }

    public function makeSign(array $requestParams)
    {
        $requestParams['timestamp'] = $this->timestamp;
        ksort($requestParams);
        $str = $this->appKey;
        foreach ($requestParams as $key => $param) {
            $str .= $key . '=' . $param;
        }
        $str .= $this->appSecret;
        $sha_str = sha1($str);
        $sign = $this->String2Hex($sha_str);
        return $sign;
    }

    /**
     * 添加新锁
     * @param $hotelId
     * @param $lockId
     * @param $roomId
     * @param $remark
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addNewLocks($hotelId, $lockId, $roomId, $remark)
    {
        $requestParams = [
            'hotelId' => $hotelId,
            'lockId' => $lockId,
            'roomId' => $roomId,
            'remark' => $remark
        ];
        $sign = $this->makeSign($requestParams);
        $requestParams['timestamp'] = $this->timestamp;
        $requestParams['sign'] = $sign;
        $request['headers'] = [
            'Authorization' => $this->appKey
        ];
        $request['body'] = http_build_query($requestParams);
        $response = $this->request($this->url, '/api/locks', $request);
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return [
                'code' => 202,
                'message' => '添加新锁失败',
                'data' => []
            ];
        }
    }


    /**
     * 修改门锁信息
     * @param $hotelId
     * @param $lockId
     * @param $roomId
     * @param $remark
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateLocks($hotelId, $lockId, $roomId, $remark)
    {
        $requestParams = [
            'hotelId' => $hotelId,
            'roomId' => $roomId,
            'remark' => $remark
        ];
        $sign = $this->makeSign($requestParams);
        $requestParams['timestamp'] = $this->timestamp;
        $requestParams['sign'] = $sign;
        $request['headers'] = [
            'Authorization' => $this->appKey
        ];
        $request['body'] = http_build_query($requestParams);
        $response = $this->request($this->url, '/api/locks/' . $lockId, $request, 'PUT');
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return [
                'code' => 202,
                'message' => '修改门锁锁信息失败',
                'data' => []
            ];
        }
    }

    /**
     * 删除门锁
     * @param $lockId
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteLocks($lockId)
    {
        $requestParams = [
            'lockId' => $lockId,
        ];
        $sign = $this->makeSign($requestParams);
        $requestParams['timestamp'] = $this->timestamp;
        $requestParams['sign'] = $sign;
        $request['headers'] = [
            'Authorization' => $this->appKey
        ];
        $request['body'] = http_build_query($requestParams);
        $response = $this->request($this->url, '/api/locks/' . $lockId, $request, 'DELETE');
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return [
                'code' => 202,
                'message' => '删除门锁失败',
                'data' => []
            ];
        }
    }

    /**
     * 获取门锁信息
     * @param string $hotelId
     * @param string $roomId
     * @param int $page
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLocksList($hotelId = '', $roomId = '', $page = 1)
    {
        $requestParams = [
            'page' => $page
        ];
        if ($hotelId) {
            $requestParams['hotelId'] = $hotelId;
        }
        if ($roomId) {
            $requestParams['roomId'] = $roomId;
        }

        $sign = $this->makeSign($requestParams);
        $requestParams['timestamp'] = $this->timestamp;
        $requestParams['sign'] = $sign;
        $request['headers'] = [
            'Authorization' => $this->appKey
        ];
        $request['query'] = $requestParams;
        $response = $this->request($this->url, '/api/locks', $request, 'GET');
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return [
                'code' => 202,
                'message' => '删除门锁失败',
                'data' => []
            ];
        }
    }


    /**
     * 向已经安装好了的门锁中添加用户使用权限
     * @param $lockId
     * @param $userId
     * @param $hotelId
     * @param $startTime 普通用户添加时必要
     * @param $endTime 普通用户添加时必要
     * @param string $type [TENANT,MANAGER]
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addUserPermissions($lockId, $userId, $hotelId, $startTime,$endTime,$type = 'TENANT')
    {
        $requestParams = [
            'userId' => $userId,
            'hotelId' => $hotelId,
            'type' => $type
        ];
        if ($type == 'TENANT'){
            $requestParams['startTime'] = $startTime;
            $requestParams['endTime'] = $endTime;
        }
        $sign = $this->makeSign($requestParams);
        $requestParams['timestamp'] = $this->timestamp;
        $requestParams['sign'] = $sign;
        $request['headers'] = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->appKey
        ];
        $request['body'] = json_encode($requestParams);
        $response = $this->request($this->url, '/api/locks/' . $lockId . '/permissions', $request);
        return $response;
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return [
                'code' => 202,
                'message' => '添加用户权限失败',
                'data' => []
            ];
        }
    }

    /**
     * 删除用户权限
     * @param $lockId
     * @param $userId
     * @param $hotelId
     * @param string $type @value in [TENANT,MANAGER]
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException]
     */
    public function deleteUserPermissions($lockId, $userId, $hotelId, $type = 'TENANT')
    {
        $requestParams = [
            'userId' => $userId,
            'hotelId' => $hotelId,
            'type' => $type
        ];
        $sign = $this->makeSign($requestParams);
        $requestParams['timestamp'] = $this->timestamp;
        $requestParams['sign'] = $sign;
        $request['headers'] = [
            'Authorization' => $this->appKey,
        ];
        $request['body'] = json_encode($requestParams);
        return $request;
        $response = $this->request($this->url, '/api/locks/' . $lockId . '/permissions', $request, 'DELETE');
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return [
                'code' => 202,
                'message' => '添加用户权限失败',
                'data' => []
            ];
        }
    }

    /**
     * 老板子同步时间
     * @param $lockId
     * @param $userId
     * @param $hotelId
     * @param string $type
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function syncTime($lockId, $userId, $hotelId, $type = 'TENANT')
    {
        $requestParams = [
            'userId' => $userId,
            'hotelId' => $hotelId,
            'type' => $type
        ];
        $sign = $this->makeSign($requestParams);
        $requestParams['timestamp'] = $this->timestamp;
        $requestParams['sign'] = $sign;
        $request['headers'] = [
            'Authorization' => $this->appKey
        ];
        $request['query'] = $requestParams;
        $response = $this->request($this->url, '/api/locks/' . $lockId . '/packets/time', $request, 'GET');
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return [
                'code' => 202,
                'message' => '获取同步时间失败',
                'data' => []
            ];
        }
    }


    /**
     * 获取门锁事件指令 包括 开锁  和 事件
     * @param $lockId
     * @param $userId
     * @param $hotelId
     * @param string $type
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getEvents($lockId, $userId, $hotelId, $type = 'TENANT')
    {
        $requestParams = [
            'userId' => $userId,
            'hotelId' => $hotelId,
            'type' => $type
        ];
        $sign = $this->makeSign($requestParams);
        $requestParams['timestamp'] = $this->timestamp;
        $requestParams['sign'] = $sign;
        $request['headers'] = [
            'Authorization' => $this->appKey
        ];
        $request['query'] = $requestParams;
        $response = $this->request($this->url, '/api/locks/' . $lockId . '/packets/event', $request, 'GET');
        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return [
                'code' => 202,
                'message' => '获取同步时间失败',
                'data' => []
            ];
        }
    }
}