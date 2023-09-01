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

namespace app\common\model;

use cores\BaseModel;

/**
 * 商品与分类关系模型
 * Class GoodsCategoryRel
 * @package app\common\model
 */
class GoodsCategoryRel extends BaseModel
{
    // 定义表名
    protected $name = 'goods_category_rel';

    // 定义主键
    protected $pk = 'id';

    protected $updateTime = false;

}
