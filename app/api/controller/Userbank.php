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

namespace app\api\controller;

use app\api\model\Userbank as ApiUserbank;
use app\api\service\User as UserService;
use app\api\validate\passport\CheckUserBank;

/**
 * 绑定的银行卡
 */
class Userbank extends Controller
{
    /**
     * 银行卡列表
     * /index.php?s=/api/userbank/banklist
     * 
     */
    public function bankList()
    {   
        $list = ApiUserbank::getList(UserService::getCurrentLoginUserId());
        return $this->renderSuccess(compact('list')); 
    }
    /**
     * 绑定银行卡
     * /index.php?s=/api/userbank/editbank
     * {"user_bank_id":1}
     *
     */
    public function addBank()
    {
        $param = $this->postForm();
        //当前用户id
        $param['user_id'] = UserService::getCurrentLoginUserId();
        $param['is_delete'] = 0;
        $result = validate(CheckUserBank::class)->scene('add')->check($param);
        if (!$result) {
            return $this->renderError(validate()->getError());
        }
        $bank_name = checkBankNumber($param['card_no']);
        //银行卡号校验
        if (!$bank_name) {
            return $this->renderError('银行卡格式错误');
        }
        $param['bank_name'] = $bank_name;
        $model = new ApiUserbank();
        if ($model->add($param)) {
            return $this->renderSuccess('添加成功');
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }
    /**
     * 编辑银行卡
     * /index.php?s=/api/userbank/editbank
     * {"user_bank_id":1}
     *
     */
    public function editBank(int $user_bank_id)
    {
        $param = $this->postForm();
        //当前用户id
        $param['user_id'] = UserService::getCurrentLoginUserId();
        $param['is_delete'] = 0;
        $param['user_bank_id'] = $user_bank_id;
        $model = ApiUserbank::detail($user_bank_id);
        if (!$model) {
            return $this->renderError('银行卡信息不存在');
        }
        if ($model->user_id != $param['user_id']) {
            return $this->renderError('请更新您自己的银行卡信息');
        }
        $validate = new CheckUserBank($user_bank_id ?? 0);
        $result = $validate->scene('edit')->check($param);
        if (!$result) {
            return $this->renderError($validate->getError());
        }
        $bank_name = checkBankNumber($param['card_no']);
        //银行卡号校验
        if (!$bank_name) {
            return $this->renderError('银行卡格式错误');
        }
        $param['bank_name'] = $bank_name;
        // 更新记录
        if ($model->edit($param)) {
            return $this->renderSuccess('更新成功');
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }
    /**
     * 默认银行卡设置
     * /index.php?s=/api/userbank/delete
     * {"user_bank_id":1}
     *
     */
    public function isused(int $user_bank_id)
    {
        // 详情记录
        $model = ApiUserbank::detail($user_bank_id);
        $param['user_id'] = UserService::getCurrentLoginUserId();
        if (!$model) {
            return $this->renderError('银行卡信息不存在');
        }
        if ($model->user_id != $param['user_id']) {
            return $this->renderError('请设置您自己的银行卡信息');
        }
        if (!$model->isused($param['user_id'])) {
            return $this->renderError($model->getError() ?: '设置失败');
        }
        return $this->renderSuccess('设置成功');
    }
    /**
     * 删除银行卡
     * /index.php?s=/api/userbank/delete
     * {"user_bank_id":1}
     *
     */
    public function delete(int $user_bank_id)
    {
        // 详情记录
        $model = ApiUserbank::detail($user_bank_id);
        $param['user_id'] = UserService::getCurrentLoginUserId();
        if (!$model) {
            return $this->renderError('银行卡信息不存在');
        }
        if ($model->user_id != $param['user_id']) {
            return $this->renderError('请删除您自己的银行卡信息');
        }
        if (!$model->remove()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
