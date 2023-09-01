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

namespace app\store\controller\user;

use app\store\controller\Controller;
use app\store\model\user\BalanceLog as BalanceLogModel;

/**
 * 余额明细
 * Class Balance
 * @package app\store\controller\user
 */
class Balance extends Controller
{
    /**
     * 余额明细
     * @return mixed
     */
    public function log()
    {
        $model = new BalanceLogModel;
        $list = $model->getList($this->request->param());
        return $this->renderSuccess(compact('list'));
    }
}
