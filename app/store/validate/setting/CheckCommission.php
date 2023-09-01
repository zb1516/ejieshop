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

namespace app\store\validate\setting;

use think\Validate;

/**
 * 验证
 * Class Login
 * @package app\api\validate\passport
 */
class CheckCommission extends Validate
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        // 设置比例 (用户输入)
        'scale_value' =>  ['require', 'float', 'between' => '0,1']
    ];

    /**
     * 验证提示
     * @var string[]
     */
    protected $message  =   [
        'scale_value.require' => '佣金比不能为空',
        'scale_value.between'  => '比例值只能在0-1之间',
    ];
}