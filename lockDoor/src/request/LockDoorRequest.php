<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 9:48
 * Email:498807233@qq.com
 */

namespace LockDoor\Request;

use GuzzleHttp\Client;

trait LockDoorRequest
{
    /**
     * @param $base_url
     * @param $uri
     * @param array $params
     * @param string $method
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($base_url, $uri, $params = [], $method = 'POST')
    {
        // TODO: Implement request() method.
        $config = [
            'base_uri' => $base_url,
        ];
        $client = new Client($config);
        try {
            $response = $client->request($method, $uri, $params);
            if ($response->getStatusCode() == 200) {
                return $response;
            }else{
                return [];
            }
        } catch (\Exception $exception) {
            return [];
        }


    }
}