<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/12
 * Time: 11:17
 * Email:498807233@qq.com
 */

namespace LockDoorTest;

use PHPUnit\Framework\TestCase;

use LockDoor\Token\HoneyComb\HoneCombIOTToken;

class HoneCombIOTTokenTest extends TestCase
{
    public $token;

    function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->token = new HoneCombIOTToken();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetToken()
    {
        $tokenArr = $this->token->getToken(true);
        $this->assertIsArray($tokenArr);
        return $tokenArr;
    }

    /**
     * @depends testGetToken
     * @param array $tokenArr
     */
    public function testTokenHasAccessTokenKey(array $tokenArr)
    {
        $this->assertArrayHasKey('accessToken', $tokenArr);
    }

    /**
     * @depends testGetToken
     * @param array $tokenArr
     */
    public function testTokenHasExpiresInKey(array $tokenArr)
    {
        $this->assertArrayHasKey('expiresIn', $tokenArr);
    }

    /**
     * @depends testGetToken
     * @param array $tokenArr
     */
    public function testTokenHasTimestampKey(array $tokenArr){
        $this->assertArrayHasKey('timestamp',$tokenArr);
    }

}
