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
 * 规格/属性(值)模型
 * Class SpecValue
 * @package app\common\model
 */
class SpecValue extends BaseModel
{
    // 定义表名
    protected $name = 'spec_value';

    // 定义主键
    protected $pk = 'spec_value_id';

    protected $updateTime = false;

    /**
     * 关联规格组表
     * @return $this|\think\model\relation\BelongsTo
     */
    public function spec()
    {
        return $this->belongsTo('Spec');
    }

}
