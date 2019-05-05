<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/11
 * Time: 15:33
 * Email:498807233@qq.com
 */

namespace LockDoor\Device\HoneComb;


use LockDoor\Device\Device;

class HoneCombIOTDevice extends Device
{

    public $baseUri = BASE_URL;

    public $uri;

    public $authorization = [];

    /**
     * get 请求时得其他参数 如 pageNumber pageSize
     * @var
     */
    public $options;

    /**
     * HoneCombIOTDevice constructor.
     * @param  $token
     */
    public function __construct($token)
    {
        $this->options = [
            'pageNumber' => 0,
            'pageSize' => 50
        ];
        $this->uri = '/devices';
        $this->getToken($token);
    }


    /**
     * 蜂巢IOT token
     * @param object $token
     */
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
        $tokenArr = json_decode($tokenString, true);
        $this->accessToken = $tokenArr['accessToken'];
        $this->authorization = [
            'Authorization' => 'Bearer ' . $this->accessToken
        ];
    }

    /**
     * 绑定设备
     * @param string $name
     * @param string $secret
     * @param array $tags
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function bind($name = '', $secret = '', array $tags = [])
    {
        if (!$name || !$secret) {
            return 'device name Or device secret is not found';
        }
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $requestParams['body'] = json_encode([
            'name' => $name,
            'secret' => $secret,
            'tags' => $tags
        ]);
        $requestParams['debug'] = false;
        $requestParams['http_errors'] = false;
        $response = $this->request($this->baseUri, $this->uri, $requestParams);
        return $response;
    }

    /**
     * @param array $options
     * @param string $search
     * @param string $product
     * @param string $deviceId
     * @param array $tags
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $options = [], string $search = '', string $product = '', string $deviceId = '', array $tags = [])
    {
        $options = $options ? $options : $this->options;
        $mainQuery = [];
        /**
         * 几个参数在蜂巢那边时and 查询 调用时 注意
         */
        if ($search) {
            $mainQuery['search'] = $search;
        }
        if ($product) {
            $mainQuery['product'] = $product;
        }
        if ($deviceId) {
            $mainQuery['deviceId'] = $deviceId;
        }
        if ($tags) {
            $mainQuery['tags'] = implode('&tags=', $tags);
        }
        $finalQuery = array_merge($options, $mainQuery);
        $requestParams['query'] = $finalQuery;
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $response = $this->request($this->baseUri, $this->uri, $requestParams, 'GET');
        return $response;
    }

    /**
     *
     * 删除设备
     * @param array $deviceIds
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(array $deviceIds)
    {
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $requestParams['body'] = json_encode($deviceIds);
        $response = $this->request($this->baseUri, $this->uri, $requestParams, 'DELETE');
        return $response;
    }
}