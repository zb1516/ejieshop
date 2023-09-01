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

use app\common\model\Region as RegionModel;

/**
 * 地区模型
 * Class Region
 * @package app\api\model
 */
class Region extends RegionModel
{

    /**
     * 获取地区信息
     * @param array $param 查询条件
     * @param int $listRows 分页数量
     * @return mixed|\think\model\Collection|\think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function detail(string $code)
    {
        return static::getIdByCode($code);
    }
}
