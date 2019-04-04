<?php

namespace LockDoor;


trait LockDoor
{
    public function pkcs5($str){
        $padLen = 8 - strlen($str) %8;
        return str_pad($str,$padLen,'0x0'.$padLen);
    }
}