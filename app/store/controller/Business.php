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

use app\store\model\Business as StoreBusiness;
use app\store\model\store\UserRole;
use app\store\validate\business\CheckBusiness;
use think\response\Json;

/**
 * 门店管理
 * Class Business
 * @package app\api
 */
class Business extends Controller
{

    /**
     * 门店管理员列表
     * /index.php?s=/store/business/storeuserlist
     *{"form":{"name":"门店管理员名"}}
     *
     */
    public function storeUserList()
    {
        $data = UserRole::getList($this->request->param());

        return $this->renderSuccess($data, "成功");
    }
     /**
     * 已绑定门店的管理员列表
     * /index.php?s=/store/business/storebinduserlist
     *{"form":{"name":"门店管理员名"}}
     *
     */
    public function storebindUserlist()
    {
        $data = UserRole::storebindUserlist($this->request->param());

        return $this->renderSuccess($data, "成功");
    }
    /**
     * 门店列表
     * /index.php?s=/store/business/storelist
     * {"form":{"page":1,"title":"","province_id":110000,"city_id":110010,"region_id":110101,"status":1}}
     *
     */
    public function storeList()
    {      
        $list = StoreBusiness::storeList($this->request->param());
        return $this->renderSuccess(compact('list')); 
    }
    /**
     * 添加门店
     * @return Json
     * /index.php?s=/store/business/addbusiness
     * {"form":{"title":"门店名称","mobile":"15701587457","store_address":"详细地址","province_id":"省份code","city_id":"城市code","region_id":"区code","store_user_id":"管理员id","merchant_name":"商家姓名","business_license":"门店营业执照","door_head_photo":"商家门头照片 , 分割图片","store_photos":"商家门店照片"}}
     * @throws \cores\exception\BaseException
     */
    public function addBusiness()
    {
        $param = $this->postForm();
        $param['province_id'] = $param['cascader'][0] ?? '';
        $param['city_id'] = $param['cascader'][1] ?? '';
        $param['region_id'] = $param['cascader'][2] ?? '';

        $result = validate(CheckBusiness::class)->check($param);
        if (!$result) {
            return $this->renderError(validate()->getError());
        }
        
        $model = new StoreBusiness;
        if ($model->add($param)) {
            return $this->renderSuccess('添加成功');
        }
        return $this->renderError($model->getError() ?: '添加失败');
    
    }
     /**
     * 编辑门店
     * /index.php?s=/store/business/edit
     *{"form":{"name":"门店管理员名"}}
     *
     */
    public function edit(int $businessId)
    {
        $param = $this->postForm();
        $param['province_id'] = $param['cascader'][0] ?? '';
        $param['city_id'] = $param['cascader'][1] ?? '';
        $param['region_id'] = $param['cascader'][2] ?? '';
        $result = validate(CheckBusiness::class)->check($param);
        if (!$result) {
            return $this->renderError(validate()->getError());
        }
        
        $model = StoreBusiness::detail($businessId);
        if(empty($model)){
            return $this->renderSuccess('门店不存在');
        }
        // 更新记录
        if ($model->edit($param, $businessId)) {
            return $this->renderSuccess('更新成功');
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }
     /**
     * 删除门店
     * /index.php?s=/store/business/delete
     * {"businessId":1}
     *
     */
    public function delete(int $businessId)
    {
        // 详情记录
        $model = StoreBusiness::detail($businessId);
        if (!$model->remove()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
