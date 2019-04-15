<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/15
 * Time: 14:41
 * Email:498807233@qq.com
 */

namespace LockDoor\device\HoneComb;


class HoneCombIOTDeviceTags extends HoneCombIOTDevice
{
    public function __construct($deviceId)
    {
        parent::__construct();
        $this->uri = '/devices/' . $deviceId . '/tags';
    }


    /**
     * 修改设备标签
     * @param $tags
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateTags($tags)
    {
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $requestParams['body'] = json_encode($tags);
        return $this->request($this->baseUri, $this->uri, $requestParams);
    }

    /**
     * 删除设备标签
     * @param $tags
     * @return array|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteTags($tags)
    {
        $requestParams['headers'] = array_merge(HONE_COMB_IOT_HEADERS, $this->authorization);
        $requestParams['body'] = json_encode($tags);
        return $this->request($this->baseUri, $this->uri, $requestParams, 'DELETE');
    }
}