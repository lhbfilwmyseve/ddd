<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 17:05
 * Email:498807233@qq.com
 */

date_default_timezone_set('Asia/Chongqing');
include "../vendor/autoload.php";

$honeyCombAuth = new \LockDoor\auth\HoneyComb\HoneyCombIOTAuth();
$res = $honeyCombAuth();
var_dump($res->getBody()->getContents());
//echo json_encode($res->getBody());
echo "\n";