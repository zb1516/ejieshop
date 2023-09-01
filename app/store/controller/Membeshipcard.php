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

namespace app\store\controller;

use app\store\model\MembeShipCardConfig as MembeShipCardConfigModel;
use app\store\validate\membeshipcard\CheckMembeshipCard;
use think\response\Json;

/**
 * 会员卡管理
 * Class Membeshipcard
 * @package app\api
 */
class Membeshipcard extends Controller
{

    /**
     * 会员卡列表
     * /index.php?s=/store/membeshipcard/list
     *
     */
    public function list()
    {
        $list = MembeShipCardConfigModel::list();
        return $this->renderSuccess(compact('list'), "成功");
    }
    /**
     * 添加会员卡
     * @return Json
     * /index.php?s=/store/membeshipcard/add
     * {"form":{"name":"普通会员卡(体验卡)","amount":"499.1","validity_month":"3","is_recharge":"0","discount":"0.88","image_url":"/upload/han.png","commission":"0.05","goods_id":"1","equity_remark":"每个月五斤","gift_remark":"4斤精选,1斤猪油"}}
     * @throws \cores\exception\BaseException
     */
    public function add()
    {
        $param = $this->postForm();

        $result = validate(CheckMembeshipCard ::class)->check($param);
        if (!$result) {
            return $this->renderError(validate()->getError());
        }
        
        $model = new MembeShipCardConfigModel;
        if ($model->add($param)) {
            return $this->renderSuccess('添加成功');
        }
        return $this->renderError($model->getError() ?: '添加失败');
    
    }
    /**
     * 编辑会员卡
     * /index.php?s=/store/membeshipcard/edit
     *{"form":{"name":"普通会员卡(体验卡)","amount":"499.1","validity_month":"3","is_recharge":"0","discount":"0.88","image_url":"/upload/han.png","commission":"0.05","goods_id":"1","equity_remark":"每个月五斤","gift_remark":"4斤精选,1斤猪油"}}
     *
     */
    public function edit(int $membership_card_id)
    {
        $param = $this->postForm();
        
        $result = validate(CheckMembeshipCard::class)->check($param);
        if (!$result) {
            return $this->renderError(validate()->getError());
        }
        
        $model = MembeShipCardConfigModel::detail($membership_card_id);
        if(empty($model)){
            return $this->renderSuccess('会员卡不存在');
        }
        // 更新记录
        if ($model->edit($param)) {
            return $this->renderSuccess('更新成功');
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }
     /**
     * 删除门店
     * /index.php?s=/store/business/delete
     * {"membership_card_id":1}
     *
     */
    public function delete(int $membership_card_id)
    {
        // 详情记录
        $model = MembeShipCardConfigModel::detail($membership_card_id);
        if (!$model->remove()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
