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

use app\api\model\User as UserModel;
use app\api\model\user\ApplyLog as ApplyLogModel;
use app\api\model\Userbank as UserbankModel;
use app\api\validate\user\WithDrawl;
use app\common\enum\user\balanceLog\Scene as SceneEnum;
use app\common\exception\BaseException;
use app\api\model\UserCoupon as UserCouponModel;
use app\api\service\User as UserService;
use app\store\model\user\BalanceLog as BalanceLogModel;
use think\response\Json;

/**
 * 用户管理
 * Class User
 * @package app\api
 */
class User extends Controller
{
    /**
     * 当前用户详情
     * @return Json
     * @throws BaseException
     */
    public function info(): Json
    {
        // 当前用户信息
        $userInfo = UserService::getCurrentLoginUser(true);
        // 获取用户头像
        $userInfo['avatar'];
        // 获取会员等级
        $userInfo['grade'];
        return $this->renderSuccess(compact('userInfo'));
    }

    /**
     * 账户资产
     * @return Json
     * @throws BaseException
     */
    public function assets(): Json
    {
        // 当前用户信息
        $userInfo = UserService::getCurrentLoginUser(true);
        // 用户优惠券模型
        $model = new UserCouponModel;
        // 返回数据
        return $this->renderSuccess([
            'assets' => [
                'balance' => $userInfo['balance'],  // 账户余额
                'points' => $userInfo['points'],    // 会员积分
                'coupon' => $model->getCount($userInfo['user_id']),    // 优惠券数量(可用)
            ]
        ]);
    }

    /**
     * 手机号绑定
     * @return Json
     * @throws \cores\exception\BaseException
     */
    public function bindMobile(): Json
    {
        $model = new UserModel;
        if (!$model->bindMobile($this->postForm())) {
            return $this->renderSuccess($model->getError() ?: '操作失败');
        }
        return $this->renderSuccess('恭喜您，手机号绑定成功');
    }

    /**
     * 用户提现状态
     * @return Json
     * @throws \cores\exception\BaseException
     */
    public function withDrawlStatus():json
    {
        $model = new UserModel();
        //判断用户提现状态
        if(false == $model->withDrawlStatus()){
            return $this->renderSuccess(['with_drawl_status'=>0],'返回成功');
        }
        return $this->renderSuccess(['with_drawl_status'=>1],"返回成功");
    }

    /**
     * 提现申请写入记录
     * @return Json
     * @throws \cores\exception\BaseException
     */
    public function withDrawlApply():Json
    {
        $model = new ApplyLogModel;
        $params=$this->postForm();
        //验证
        $result=validate(WithDrawl::class)->check($params);
        if (!$result) return $this->renderError(validate()->getError());
        $userInfo=UserService::getCurrentLoginUser();
        //判断用户提现金额是否超过用户余额
        $balance=bcsub($userInfo['balance'],$params['money']);
        if($balance < 0 ) return  $this->renderError('可提现金额不足！');
        //获取当前用户绑定的默认银行卡
        $bankInfo=(new UserbankModel())->getUsedBankDetail($userInfo['user_id']);
        if (empty($bankInfo)) return  $this->renderError('请先绑定银行卡！');
        $params['card_no'] = $bankInfo['card_no'];
        $params['user_id'] = $userInfo['user_id'];
        $params['store_id'] = $model::$storeId;
        if(!$model->apply($params)) return  $this->renderError($model->getError() ?: '操作失败');
        //写入余额变动记录
        $BalanceLogModel=new BalanceLogModel();
        $BalanceLogModel->withDrawl(SceneEnum::WITHDRAWL,[
            'user_id'=> $userInfo['user_id'],
            'money'=> -$params['money']
        ],['money'=>$params['money']]);
        //写入冻结金额
        $userModel=new UserModel;
        $userModel->updateBalance($params['money'] , $balance);
        return $this->renderSuccess("提现成功，请等待审核!");
    }
}
