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
declare (strict_types=1);

namespace app\common\model\user;

use cores\BaseModel;
use think\model\relation\BelongsTo;

/**
 * 用户积分变动明细模型
 * Class PointsLog
 * @package app\common\model\user
 */
class PointsLog extends BaseModel
{
    // 定义表名
    protected $name = 'user_points_log';

    // 定义主键
    protected $pk = 'log_id';

    protected $updateTime = false;

    /**
     * 关联会员记录表
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        $module = self::getCalledModule();
        return $this->belongsTo("app\\{$module}\\model\\User");
    }

    /**
     * 新增记录
     * @param array $data
     */
    public static function add(array $data)
    {
        $static = new static;
        empty($data['store_id']) && $data['store_id'] = $static::$storeId;
        $static->save($data);
    }

    /**
     * 新增记录 (批量)
     * @param $saveData
     * @return bool
     */
    public function onBatchAdd($saveData): bool
    {
        return $this->addAll($saveData) !== false;
    }
}
