<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/11
 * Time: 15:33
 * Email:498807233@qq.com
 */

namespace LockDoor\device\HoneComb;


use LockDoor\Device\Device;
use LockDoor\Token\HoneyComb\HoneCombIOTToken;

class HoneCombIOTDevice extends Device
{
    public $deviceName = 'MU6610-BC-A';

    public $baseUri = BASE_URL;

    public $uri;

    public $authorization = [];

    public function __construct()
    {
        $this->getToken();
    }

    /**
     * 绑定设备
     * @param string $secret
     * @param array $tags
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function bind($secret = '', array $tags = [])
    {
        echo json_encode([
            'name' => $this->deviceName,
            'secret' => '0028004A5353510D20393035|A5B3C2950117',
            'tags' => $tags
        ]);
        if (!$secret) {
            return 'secret not found';
        }
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $requestParams['body'] = json_encode([
            'name' => $this->deviceName,
            'secret' => '0028004A5353510D20393035|A5B3C2950117',
            'tags' => $tags
        ]);
        $requestParams['debug'] = true;
        $response = $this->request($this->baseUri, $this->uri, $requestParams);
         var_dump($response);
        echo PHP_EOL;
        exit;
//        return $response;
    }



    public function getToken()
    {
        $token = new HoneCombIOTToken();
        $this->accessToken = $token->getToken();
        $this->authorization = [
            'Authorization'=>'Bearer '.$this->accessToken
        ];
    }

    /**
     * @param string $search
     * @param string $product
     * @param string $deviceId
     * @param array $tags
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $search, string $product, string $deviceId, array $tags)
    {
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS,$this->authorization);
        $bodyArr = [
            'search'=>$search,
            'product'=>$product,
            'deviceId'=>$deviceId,
            'tags'=>$tags
        ];
        $requestParams['body'] = json_encode($bodyArr);
        // TODO: Implement get() method.
        $response = $this->request($this->baseUri,$this->uri,$requestParams,'GET');
        return $response;
    }

    /**
     *
     * 删除设备
     * @param array $deviceIds
     * @return mixed
     */
    public function delete(array $deviceIds)
    {
        // TODO: Implement delete() method.
    }
}