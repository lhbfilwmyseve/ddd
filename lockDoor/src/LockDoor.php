<?php

namespace LockDoor;


trait LockDoor
{
    /**
     * 16转字符串
     * @param $hex
     * @return string
     */
    public function Hex2String($hex)
    {
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        return $string;
    }

    /**
     * 字符串转16
     * @param $string
     * @return string
     */
    public function String2Hex($string)
    {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $ascii = dechex(ord($string[$i]));
            if (strlen($ascii) < 2) {
                $ascii = '0' . $ascii;
            }
            $hex .= $ascii;
        }
        return $hex;
    }
}