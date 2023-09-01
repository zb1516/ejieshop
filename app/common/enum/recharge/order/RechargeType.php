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

namespace app\common\enum\recharge\order;

use app\common\enum\EnumBasics;

/**
 * 用户充值订单-充值方式枚举类
 * Class RechargeType
 * @package app\common\enum\recharge\order
 */
class RechargeType extends EnumBasics
{
    // 自定义金额
    const CUSTOM = 10;

    // 套餐充值
    const PLAN = 20;

    // 会员卡充值
    const CARD = 30;

    /**
     * 获取订单类型值
     * @return array
     */
    public static function data()
    {
        return [
            self::CUSTOM => [
                'name' => '自定义金额',
                'value' => self::CUSTOM,
            ],
            self::PLAN => [
                'name' => '套餐充值',
                'value' => self::PLAN,
            ],
            self::CARD => [
                'name' => '会员卡充值',
                'value' => self::CARD,
            ],
        ];
    }

}