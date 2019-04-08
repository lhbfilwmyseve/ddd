<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 10:51
 * Email:498807233@qq.com
 */
use LockDoor\Request\LockDoorRequest;
use LockDoor\Response\LockDoorResponse;

if (!function_exists('request')){
    function request($url,$params,$method){
        $request = new LockDoorRequest();
        $response = new LockDoorResponse();

        $requestRes = $request->request($url,$params,$method);
        $responseArr = $response->response($requestRes);
        if (!isset($responseArr['code']) || $responseArr['code'] > 0 || $responseArr['code'] < 0) {
            return [];
        }
        return $responseArr['data'];
    }
}