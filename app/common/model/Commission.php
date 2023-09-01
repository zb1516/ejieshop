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
 * 推荐人佣金比模型
 * Class Article
 * @package app\common\model
 */
class Commission extends BaseModel
{
    // 定义表名
    protected $name = 'commission';

    // 定义主键
    protected $pk = 'commission_id';

    /**
     * 新增数据
     * @param int $commissionId
     * @param array $with
     * @return array|null|static
     */
    public static function add(array $data):bool
    {
        $static=new static;
        return $static->save($data);
    }

    /**
     *  查询单条数据
     * @param string $scaleName
     * @param array $with
     * @return Commission|array|false|null
     */
    public static function detail(array $scaleName)
    {
        return static::get($scaleName);
    }

    /**
     * 更新数据
     * @param array $data
     * @param array $where
     * @return bool
     */
    public static function edit(array $data , array $where):bool
    {
        static::update($data,$where);
        return true;
    }
}
