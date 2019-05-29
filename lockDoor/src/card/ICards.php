<?php


namespace LockDoor\card;


use LockDoor\Request\LockDoorRequest;

abstract class ICards
{
    use LockDoorRequest;

    public $dd;
    abstract public function make();

    abstract public function read();
}