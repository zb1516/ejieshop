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
 * 模型类：用户会员卡
 * Class MembeShipCard
 * @package app\common\model
 */
class MembeShipCard extends BaseModel
{
    // 定义表名
    protected $name = 'user_membership_card';

    // 定义主键
    protected $pk = 'id';

    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'create_time';
    // 不允许全局查询store_id
    protected $isGlobalScopeStoreId = false;
    /**
     * 详情
     *
     * @param array $data
     * @return void
     */
    public static function detail(array $data)
    {
        return self::where($data)->find();
    }
    /**
     * 获取有效的会员卡列表
     * @param int $use_id
     * @return void
     */
    public static function getList(int $user_id)
    {
        return (new static )->where('user_id', '=', $user_id)
            ->where('deadline_time', '>', time())
            ->order(['create_time' => 'desc'])
            ->select();
    }
    /**
     * 关联会员权益领取记录表
     * @return \think\model\relation\BelongsTo
     */
    public function usercardlog()
    {
        return $this->hasMany('MembeShipCardLog', 'user_membership_card_id', 'id');
    }
}
