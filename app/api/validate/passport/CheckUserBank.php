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

namespace app\api\validate\passport;

use app\common\model\Userbank;
use app\common\validate\BaseValidate;
/**
 * 验证类：验证银行卡绑定
 * Class SmsCaptcha
 * @package app\api\validate\passport
 */
class CheckUserBank extends BaseValidate
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'user_bank_id' => 'require|number',
        // 银行卡号 (用户输入)
        'card_no' => 'require|max:30|unique:' . Userbank::class . ',user_id^card_no^is_delete,{pkId}',
        //支行名称
        'bank_branch' => 'require|max:80',
    ];

    /**
     * 验证提示
     * @var string[]
     */
    protected $message = [
        'user_bank_id.require' => 'user_bank_id不能为空',
        'user_bank_id.number' => 'user_bank_id无效',
        'card_no.require' => '银行卡号不能为空',
        'bank_branch.require' => '支行名称不能为空',
        'card_no.unique' => '银行卡已存在,请勿重复提交',
        'card_no.max' => '银行卡号不能超过30位',
        'bank_branch.max' => '支行名称不能超过80位',
    ];

    protected $scene = [
        'add' => ['card_no', 'bank_branch'],
        'edit' => ['user_bank_id', 'card_no', 'bank_branch'],
    ];
}
