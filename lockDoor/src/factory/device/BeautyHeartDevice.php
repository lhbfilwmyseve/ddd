<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/5/14
 * Time: 15:59
 * Email:498807233@qq.com
 */

namespace LockDoor\factory\device;


use LockDoor\Request\LockDoorRequest;

class BeautyHeartDevice
{
    use LockDoorRequest;
    private $companyId = '';
    private $time = '';
    private $deviceInfo = [];
    private $url = 'https://sdk.mx-zy.com/dyAppV2/key/getTempPasswd.do';

    function __construct($companyId, array $deviceInfo)
    {
        $this->companyId = $companyId;
        $this->time = date('Y-m-d H:i:s');
        $this->deviceInfo = $deviceInfo;
    }

    public function open()
    {
        $requestData = [
            'companyId' => $this->companyId,
            'keyNum' => $this->deviceInfo['Index'],
            'openDoorPwd' => $this->deviceInfo['OpenPwd'],
            'secretKey' => $this->deviceInfo['OpenPwdKey'],
            'time' => $this->time,
            'sign' => $this->_sign($this->companyId, $this->deviceInfo['Index'], $this->time)
        ];
        $request = [
            'form_params' => $requestData
        ];
        $response = $this->request($this->url, '', $request);
        if ($response->getStatusCode() !== 200) {
            return ['code' => 202, 'message' => '请求错误', 'data' => []];
        }

        $contentStr = $response->getBody()->getContents();

        $contentArr = json_decode($contentStr, true);
        if (isset($contentArr['code']) && $contentArr['code'] == 100 && isset($contentArr['data']) && $contentArr['data']) {
            return [
                'code' => 200,
                'message' => 'success',
                'data' => [
                    'password' => $contentArr['data']
                ]
            ];
        } else {
            return [
                'code' => 202,
                'message' => 'fail',
                'data' => []
            ];
        }
    }

    private function _sign($companyId, $keyNum, $time)
    {
        return md5('companyId=' . $companyId . '&keyNum=' . $keyNum . '&time=' . $time);
    }
}