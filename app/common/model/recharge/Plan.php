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

namespace app\common\model\recharge;

use cores\BaseModel;

/**
 * 用户充值订单模型
 * Class Plan
 * @package app\common\model\recharge
 */
class Plan extends BaseModel
{
    // 定义表名
    protected $name = 'recharge_plan';

    // 定义主键
    protected $pk = 'plan_id';

    /**
     * 充值套餐详情
     * @param $plan_id
     * @return null|static
     */
    public static function detail($plan_id)
    {
        return self::get($plan_id);
    }

}