<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 10:27
 * Email:498807233@qq.com
 */

define('CONFIG_DIR', __DIR__);
define('BASE_DIR', dirname(CONFIG_DIR));
define('BASE_URL', 'https://api.fengchaoiot.com');
define('TOKEN_FILE', CONFIG_DIR . '/token.txt');
define('TOKEN_DRIVER','file');
/**
 * 蜂巢请求headers 根据具体需求在业务逻辑中修改
 */
define('HONE_COMB_IOT_HEADERS',[
    'Content-Type' => 'application/json',
    'X-Accept-Version' => 'beehive.v1'
]);