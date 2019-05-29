<?php


namespace LockDoor\card;

use Exception;

/**
 *
 * Class Mark 制卡mark字段描述
 * @package LockDoor\card
 * @link  https://www.yuque.com/docs/share/81911a0d-5640-47c6-80df-988a05267d60#3f59f318
 * @property false|int breakfast  是否有早餐,小于等于0为否，大于0为是。
 * @property false|int blacklist 表示添加/移出黑名单（挂失卡）,小于等于0为否，大于0为是
 * @property false|int setEndTime 是否设置终止时间（退房卡），小于等于0为否，大于0为是。
 * @property  false|int lockDoor 是否封门（配置卡）只让某一种卡能开门,小于等于0为否，大于0为是。
 * @property false|int lockCard 是否封卡（配置卡）让某一类型的卡不能开门。小于等于0为否，大于0为是。
 * @property false|int setMode 是否设置为通道模式（配置卡，配置门锁状态）。小于等于0为否，大于0为是。
 * @property false|int alarmOfUnlock 是否假锁报警。小于等于0为否，大于0为是。
 * @property false|int setCanOpenOfLock 是否反锁可开（用于配置门锁）。小于等于0为否，大于0为是。
 * @property false|int replaceCard 替代前卡(序列号为开始时间：总卡、楼栋、楼层、退房、多门、清号、锁体设置、区域、入网、清网；宾客卡类似于退房卡功能；)。小于等于0为否，大于0为是。
 * @property false|int canOpenOfLock 是否可开反锁（用于卡开门权限，对于超级权限），小于等于0为否，大于0为是。
 * @property false|int isPassCard 是否为通道卡？（用于卡片模式）。小于等于0为否，大于0为是。
 * @property false|int setArea 设置区域？（区域设置卡，大于0-设置；小于等于0-清除）
 */
class Mark
{
    private $arr = null;

    private $filter = [
        'breakfast',
        'blacklist',
        'setEndTime',
        'lockDoor',
        'lockCard',
        'setMode',
        'alarmOfUnlock',
        'alarmOfUnlock',
        'setCanOpenOfLock',
        'replaceCard',
        'canOpenOfLock',
        'isPassCard',
        'setArea'
    ];

    /**
     * @param $name
     * @param $value
     * @throws Exception
     */
    public function __set($name, $value)
    {
        if (in_array($name, $this->filter)) {
            $this->arr[$name] = $value;
        }
    }


    /**
     * 获取mark
     * @return false|string
     */
    public function getMark()
    {
        return json_encode($this->arr);
    }
}