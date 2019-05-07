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
        $config = [
            'base_uri' => $base_url,
//            'timeout' => 2.0
            'verify' => './cert.pem'
        ];
        $client = new Client($config);
        try {
            $response = $client->request($method, $uri, $params);
            if ($response->getStatusCode() == 200) {
                return $response;
            } else {
                return [];
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function requestByCURL($params)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fengchaoiot.com/api/accessToken",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: ebc70695-f35c-ee66-98ee-6f096101ab6f",
                "x-accept-version: beehive.v1"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
            echo "\n";
        }
    }
}