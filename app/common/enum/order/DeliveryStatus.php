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

namespace app\common\enum\order;

use app\common\enum\EnumBasics;

/**
 * 枚举类：订单发货状态
 * Class DeliveryStatus
 * @package app\common\enum\order
 */
class DeliveryStatus extends EnumBasics
{
    // 未发货
    const NOT_DELIVERED = 10;

    // 已发货
    const DELIVERED = 20;

    /**
     * 获取枚举数据
     * @return array
     */
    public static function data()
    {
        return [
            self::NOT_DELIVERED => [
                'name' => '未发货',
                'value' => self::NOT_DELIVERED,
            ],
            self::DELIVERED => [
                'name' => '已发货',
                'value' => self::DELIVERED,
            ],
        ];
    }

}
