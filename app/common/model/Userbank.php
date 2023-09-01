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

use app\common\model\store\User;
use app\common\model\Region as RegionModel;
use cores\BaseModel;

/**
 * 模型类：银行卡
 * Class Userbank
 * @package app\common\model
 */
class Userbank extends BaseModel
{
    // 定义表名
    protected $name = 'user_bank';

    // 定义主键
    protected $pk = 'id';

    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';
    // 不允许全局查询store_id
    protected $isGlobalScopeStoreId = false;

}
