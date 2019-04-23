<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/12
 * Time: 13:41
 * Email:498807233@qq.com
 */

namespace LockDoorTest;

use LockDoor\Auth\HoneyComb\HoneyCombIOTAuth;
use PHPUnit\Framework\TestCase;

class HoneyCombIOTAuthTest extends TestCase
{
    public function test__invoke()
    {
        $auth = new HoneyCombIOTAuth();
        $statusCode = $auth()->getStatusCode();
        $this->assertEquals(200,$statusCode);
    }
}
