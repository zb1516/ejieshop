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

namespace app\common\model;

use cores\BaseModel;

/**
 * 轮播模型
 * Class Article
 * @package app\common\model
 */
class Carousel extends BaseModel
{
    // 定义表名
    protected $name = 'carousel';

    // 定义主键
    protected $pk = 'carousel_id';


    /**
     * 单条信息
     * @param int|array $where
     * @return array|null|static
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function detail($where)
    {
        $query = static::withoutGlobalScope();
        is_array($where) ? $query->where($where) : $query->where('carousel_id', '=', $where);
        return $query->find();
    }
}
