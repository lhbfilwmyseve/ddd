<?php
/**
 * Created by LHB
 * User: LHB
 * Date: 2019/4/8
 * Time: 15:06
 * Email:498807233@qq.com
 */

namespace LockDoor\Token;


interface Token{
    public function set($string);

    public function get($key = '');

    public function delete();

    public function isVoid();

    public function reload();
}