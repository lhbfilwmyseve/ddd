<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 9:55
 * Email:498807233@qq.com
 */

namespace LockDoor\Auth;

use LockDoor\Request\LockDoorRequest;
use LockDoor\Response\LockDoorResponse;

class Auth
{

    public $request;

    public $response;

    public $authority;

    function __construct()
    {
        $this->request = new LockDoorRequest();
        $this->response = new LockDoorResponse();
        $this->authority = Authority::getInstance();
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        $url = BASE_URL.'accessToken';
        $params = array_merge($this->authority->getAuthoriryData(), ['timestamp' => time()]);
        $responseRes = $this->request->request($url, $params);
        $responseResArr = $this->response->response($responseRes);
        if (!isset($responseResArr['code']) || $responseResArr['code'] > 0 || $responseResArr['code'] < 0) {
            return [];
        }
        return $responseResArr['data'];
    }
}