<?php
// +----------------------------------------------------------------------
// | 易捷商城系统 [ 致力于通过产品和服务，帮助商家高效化开拓市场 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017~2021 https://www.yiovo.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed 这不是一个自由软件，不允许对程序代码以任何形式任何目的的再发行
// +----------------------------------------------------------------------
// | Author: 萤火科技 <admin@yiovo.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace app\store\controller\setting;

use app\store\controller\Controller;
use app\store\model\Commission as CommissionModel;
use app\store\validate\setting\CheckCommission;

/**
 * 设置佣金比例
 */
class Commission extends Controller
{
    const SCALE_NAME = 'referee';

    /**
     * 获取当前设置
     * @return \think\response\Json
     */
    public function detail(string $key)
    {
        $values=CommissionModel::detail(['scale_name'=>$key]);
        return $this->renderSuccess(compact('values'));
    }

    /**
     *  设置推荐人佣金比例
     */
    public function scale()
    {
        $params=$this->postForm();
        $result=validate(CheckCommission::class)->check($params['commission']);
        if (!$result){
            return $this->renderError(validate()->getError());
        }
        $info=CommissionModel::detail(['scale_name'=>self::SCALE_NAME]);
        if (empty($info)){
            $item=[
                'scale_name' => self::SCALE_NAME,
                'scale_value' => $params['commission']['scale_value'],
                'store_id' => $this->storeId
            ];
            if (CommissionModel::add($item)) {
                return $this->renderSuccess('保存成功');
            }
        }
        //根据推荐人比例项更新值
        CommissionModel::update(['scale_value'=>$params['commission']['scale_value']],['scale_name'=>self::SCALE_NAME]);
        return $this->renderSuccess('保存成功');
    }
}
