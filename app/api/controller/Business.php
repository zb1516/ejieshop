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

namespace app\api\controller;

use app\api\model\Business as BusinessModel;
use app\api\model\Region as RegionModel;
use app\common\library\Map;

/**
 * 门店控制器
 * Class Setting
 * @package app\store\controller
 */
class Business extends Controller
{
    /**
     * 店铺列表
     * @return array|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function list()
    {
        $params=$this->postForm();
        $location=Map::getCityLocation($params['latitude'],$params['longitude']);
        //通过地区id获取门店列表
        $businessModel=new BusinessModel;
        $list=$businessModel->getDistanceByLatLng($location['lat'],$location['lng']);
        return $this->renderSuccess(compact('list'));
    }

}
