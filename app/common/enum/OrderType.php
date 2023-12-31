<?php
// +----------------------------------------------------------------------
// | 农商商城系统 [ 致力于通过产品和服务，帮助商家高效化开拓市场 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017~2021  All rights reserved.
// +----------------------------------------------------------------------
// | Licensed 这不是一个自由软件，不允许对程序代码以任何形式任何目的的再发行
// +----------------------------------------------------------------------
// | Author: 农商科技 <>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace app\common\enum;

/**
 * 枚举类：订单类型
 * Class OrderType
 * @package app\common\enum
 */
class OrderType extends EnumBasics
{
    // 商城订单
    const ORDER = 10;

    // 余额充值订单
    const RECHARGE = 100;

    //会员卡充值订单
    const USERCARD = 200;
    /**
     * 获取订单类型值
     * @return array
     */
    public static function data()
    {
        return [
            self::ORDER => [
                'name' => '商城订单',
                'value' => self::ORDER,
            ],
            self::RECHARGE => [
                'name' => '余额充值订单',
                'value' => self::RECHARGE,
            ],
            self::RECHARGE => [
                'name' => '会员卡充值订单',
                'value' => self::USERCARD,
            ],
        ];
    }

}