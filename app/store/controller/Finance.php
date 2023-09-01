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

namespace app\store\controller;

use app\store\model\user\BalanceLog as BalanceLogModel;
use app\store\model\user\ApplyLog as ApplyLogModel;

/**
 * 财务管理
 * Class Order
 * @package app\store\controller
 */
class Finance extends Controller
{

    /**
     * 返佣列表
     * @param string $dataType
     * @return array
     */
    public function list(string $dataType)
    {
        $model = new BalanceLogModel;
        if ($dataType == $model::LIST_TYPE_COMMISSION){
            $list = $model->getBalanceList($this->request->param());
        }else{
            $applyModel=new ApplyLogModel;
            $list = $applyModel->getList($this->request->param());
        }
        return $this->renderSuccess(compact('dataType', 'list'));
    }
}
