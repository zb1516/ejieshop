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

use app\api\model\Goods;
use app\api\service\User as UserService;
use app\api\model\MembeShipCardConfig as MembershipCardConfigModel;
use app\common\library\helper;

/**
 * 用户充值会员卡管理
 * Class Membership
 * @package app\api\controller
 */
class Membership extends Controller
{

    /**
     * 返回权益配置列表数据
     * @return Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    function list() {
        $list = MembershipCardConfigModel::getList();
        return $this->renderSuccess(compact('list'));
    }

    /**
     * 验证是否购买过会员卡
     *
     * @param integer $membership_card_id
     * @return void
     */
    public function checkusercard(int $membership_card_id)
    {
        $canbuy = UserService::checkusercard($membership_card_id);
        return $this->renderSuccess($canbuy);
    }
    /**
     * 权益及赠送列表
     *
     * @return void
     */
    public function equityList()
    {
        $list = UserService::equityList();
        return $this->renderSuccess(compact('list'));
    }
}
