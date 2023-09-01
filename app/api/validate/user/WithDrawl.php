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

namespace app\api\validate\user;

use think\Validate;

/**
 * 验证类：提现提交
 * Class Checkout
 * @package app\api\validate\order
 */
class WithDrawl extends Validate
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        // 金额
        'money' => ['require', 'float', 'gt' => 0],
        // 类型
        'type' => ['require', 'float', 'gt' => 0],
    ];

    /**
     * 验证提示
     * @var array
     */
    protected $message  =   [
        'money.require' => '请选择提现金额',
        'type.require'  => '请选择提现方式',
    ];

}
