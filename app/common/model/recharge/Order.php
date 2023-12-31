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
 * Class Order
 * @package app\common\model\recharge
 */
class Order extends BaseModel
{
    // 定义表名
    protected $name = 'recharge_order';

    // 定义主键
    protected $pk = 'order_id';

    /**
     * 关联会员记录表
     * @return \think\model\relation\BelongsTo
     */
    public function user()
    {
        $module = self::getCalledModule();
        return $this->belongsTo("app\\{$module}\\model\\User");
    }

    /**
     * 关联订单套餐快照表
     * @return \think\model\relation\HasOne
     */
    public function orderPlan()
    {
        return $this->hasOne('OrderPlan', 'order_id');
    }

    /**
     * 付款时间
     * @param $value
     * @return array
     */
    public function getPayTimeAttr($value)
    {
        return format_time($value);
    }

    /**
     * 获取订单详情
     * @param $where
     * @return array|null|\think\Model
     */
    public static function detail($where)
    {
        return static::get($where);
    }

}
