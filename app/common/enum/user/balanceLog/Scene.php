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

namespace app\common\enum\user\balanceLog;

use app\common\enum\EnumBasics;

/**
 * 余额变动场景枚举类
 * Class Scene
 * @package app\common\enum\user\balanceLog
 */
class Scene extends EnumBasics
{
    // 用户充值
    const RECHARGE = 10;

    // 用户消费
    const CONSUME = 20;

    // 管理员操作
    const ADMIN = 30;

    // 订单退款
    const REFUND = 40;

    //提现
    const WITHDRAWL = 50;

    //返佣
    const RETURNPRICE = 60;

     // 用户充值会员卡
    const RECHARGECARD = 70;

    //返现
    const CASHBACK = 80;

    /**
     * 获取订单类型值
     * @return array
     */
    public static function data()
    {
        return [
            self::RECHARGE => [
                'name' => '用户充值',
                'value' => self::RECHARGE,
                'describe' => '用户充值：%s',
            ],
            self::RECHARGECARD => [
                'name' => '用户会员卡充值',
                'value' => self::RECHARGECARD,
                'describe' => '用户会员卡充值：%s',
            ],
            self::CONSUME => [
                'name' => '用户消费',
                'value' => self::CONSUME,
                'describe' => '用户消费：%s',
            ],
            self::ADMIN => [
                'name' => '管理员操作',
                'value' => self::ADMIN,
                'describe' => '后台管理员 [%s] 操作',
            ],
            self::REFUND => [
                'name' => '订单退款',
                'value' => self::REFUND,
                'describe' => '订单退款：%s',
            ],
            self::RETURNPRICE => [
                'name' => '订单返佣',
                'value' => self::RETURNPRICE,
                'describe' => '订单返佣：%s',
            ],
            self::WITHDRAWL => [
                'name' => '用户提现',
                'value' => self::WITHDRAWL,
                'describe' => '用户提现：%s',
            ],
            self::CASHBACK => [
                'name' => '用户返现',
                'value' => self::CASHBACK,
                'describe' => '用户返现：%s',
            ],
        ];
    }

}
