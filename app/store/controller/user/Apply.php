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
declare (strict_types=1);

namespace app\store\controller\user;

use app\common\enum\user\balanceLog\Scene as SceneEnum;
use app\store\controller\Controller;
use app\store\model\User as UserModel;
use app\store\model\user\BalanceLog as BalanceLogModel;
use app\store\model\user\ApplyLog as ApplyLogModel;
use think\response\Json;

/**
 * 用户提现申请管理
 * Class Apply
 * @package app\admin\controller
 */
class Apply extends Controller
{
    /**
     * 申请列表
     * @return json
     * @throws \think\db\exception\DbException
     */
    public function list():Json
    {
        $model=new ApplyLogModel();
        $params=empty($this->postForm())?[]:$this->postForm();
        $list=$model->getList($params);
        return $this->renderSuccess(compact('list'));
    }

    /**
     * 审核
     * @return void
     */
    public function aduit(int $apply_id):Json
    {
        $model=new ApplyLogModel();
        $params=$this->postForm();
        $log=$model->detail((int)$apply_id);
        //判断审核是通过还是拒绝
        if ($params['audit_status'] == 2) $this->reject($params , $log);
        if ($params['audit_status'] == 1) $this->pass($params , $log);
        return $this->renderSuccess("操作成功");
    }

    /**
     * 审核驳回
     * @param array $params
     * @param array $data
     * @return void
     */
    private function reject($params = [] , $data = [])
    {
        //修改用户冻结金额减去当前审核的一笔提现金额
        $userModel = new UserModel();
        $userInfo=UserModel::detail($data['user_id']);
        //判断用户冻结金额是否够大于0
        if($userInfo['frozen_balance'] <= 0) return $this->renderError('发生错误！');
        $frozenBalance=bcsub((string)$userInfo['frozen_balance'],(string)$data['money']);
        $balance=bcadd($userInfo['balance'] , $data['money']);
        //更新用户冻结金额
        if(!$userModel->edit($data['user_id'],['frozen_balance'=>$frozenBalance , 'balance'=>$balance])) return $this->renderError($userModel->getError() ?: '操作失败');
        //更新当前记录为拒绝状态
        $model=new ApplyLogModel();
        if(!$model->edit($data['user_id'] , $params['audit_status'] , $params['remark'])) return $this->renderError($model->getError() ?: '操作失败');
        //如果审核拒绝，给用户余额增加金额
        $BalanceLogModel=new BalanceLogModel();
        $BalanceLogModel->withDrawl(SceneEnum::CASHBACK,[
            'user_id'=> $userInfo['user_id'],
            'money'=> +$data['money']
        ],['money'=>$data['money']]);
        return true;
    }

    /**
     * 审核通过
     * @param array $params
     * @param array $data
     * @return bool
     */
    private function pass($params = [] , $data = [])
    {
        $userModel = new UserModel();
        $userInfo=UserModel::detail($data['user_id']);
        $balance=bcsub((string)$userInfo['frozen_balance'],(string)$data['money']);
        //更新用户冻结金额
        if(!$userModel->edit($data['user_id'],['frozen_balance'=>$balance])) return $this->renderError($userModel->getError() ?: '操作失败');
        //更新当前记录为通过状态
        $model=new ApplyLogModel();
        if(!$model->edit($data['user_id'] , $params['audit_status'])) return $this->renderError($model->getError() ?: '操作失败');
        return true;
    }
}
