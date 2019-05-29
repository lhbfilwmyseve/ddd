<?php

namespace LockDoorTest\cards;

use LockDoor\card\Cards;
use PHPUnit\Framework\TestCase;

class CardsTest extends TestCase
{

    public function testSetEndTime()
    {
        $cards = new Cards();
        $cards->weeks = ['dd','ee'];
        $cards->hotelId = 246;
        $cards->setStartTime(time());
        var_export("\n=================================================\n");
        var_dump(
           property_exists($cards,'startTime')
        );
        var_export("\n=================================================\n");
    }
//
//    public function test__set()
//    {
//
//    }
//
//    public function testMake()
//    {
//
//    }
//
//    public function testSetStartTime()
//    {
//
//    }
//
//    public function testRead()
//    {
//
//    }
}
