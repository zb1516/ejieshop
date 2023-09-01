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

namespace app\api\model;

use app\common\model\Business as BusinessModel;

class Business extends BusinessModel
{
    /**
     * 传入经纬度获取门店列表
     * @param $lat
     * @param $lng
     * @param $order
     * @return \app\api\model\Business[]|array|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getDistanceByLatLng($lat, $lng, $order = 'asc')
    {
        // 经度
        $field_lat = 'latitude';
        // 纬度
        $field_lng = 'longitude';
        return $this->field("*, (6378.138 * 2 * asin(sqrt(pow(sin(({$field_lng} * pi() / 180 - {$lat} * pi() / 180) / 2),2) + cos({$field_lat} * pi() / 180) * cos({$lat} * pi() / 180) * pow(sin(({$field_lat} * pi() / 180 - {$lng} * pi() / 180) / 2),2))) * 1000) as distance")
            // 按距离升序排列（由近到远）
            ->where('is_delete', '=', 0)
            ->order("distance {$order}")
            ->paginate(15);
    }
}
