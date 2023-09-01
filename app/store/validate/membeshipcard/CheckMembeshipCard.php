<?php
namespace app\store\validate\membeshipcard;

use think\Validate;

class CheckMembeshipCard extends Validate
{

    protected $rule = [
        'name' => ['require', 'max' => '30'],
        'amount' => ['require', 'float'],
        'is_recharge' => ['require', 'number', 'in:1,0'],
        'discount' => ['float', 'between:0.01,0.99'],
        'image_id' => ['require', 'max' => '11'],
        'commission' => ['require', 'float', 'between:0.01,0.99'],
        'equity_goods_id' => ['number', 'max' => '11'],
        'gift_goods_id' => ['number', 'max' => '11'],
        'validity_month' => ['require', 'number', 'max' => '10'],
        'sort' => ['require', 'number', 'max' => '11'],
    ];

    protected $message = [
        'sort.require' => '排序不能为空',
        'sort.number' => '排序必须是数字',
        'sort.max' => '排序不能超过11位',

        'is_recharge.require' => '充值类型不能为空',
        'is_recharge.in' => '充值类型只有1,0',
        'is_recharge.number' => '充值类型必须是数字',

        'equity_goods_id.max' => '权益商品ID不能超过11位',
        'equity_goods_id.number' => '权益商品ID必须是数字',

        'gift_goods_id.max' => '赠品ID不能超过11位',
        'gift_goods_id.number' => '赠品ID必须是数字',

        'name.require' => '会员卡名称不能为空',
        'name.max' => '会员卡名称不能超过30位',

        'amount.require' => '充值金额不能为空',
        'amount.float' => '充值金额必须是浮点',

        'validity_month.require' => '有效期不能为空',
        'validity_month.number' => '有效期必须是数字',
        'validity_month.max' => '有效期不能超过11位',

        'discount.float' => '商品折扣必须是浮点',

        'image_id.require' => '图片ID不能为空',
        'image_id.max' => '图片ID不能超过11位',

        'commission.require' => '邀请人分润比例不能为空',
        'commission.float' => '邀请人分润比例必须是浮点',
    ];
}
