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
 * 模型类：门店
 * Class Business
 * @package app\common\model
 */
class Business extends BaseModel
{
    // 定义表名
    protected $name = 'business';

    // 定义主键
    protected $pk = 'id';

    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';
    // 不允许全局查询store_id
    protected $isGlobalScopeStoreId = false;

    
    /**
     * 追加字段
     * @var array
     */
    protected $append = ['region','store_user_name'];
   /**
     * 获取器：门店管理员名称
     * @param $value
     * @param $data
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getStoreUserNameAttr($value, $data)
    {
        return User::where(['store_user_id' => $data['store_user_id']])->value('user_name');
    }
    /**
     * 获取器：地区名称
     * @param $value
     * @param $data
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getRegionAttr($value, $data)
    {
        return [
            'province' => RegionModel::getIdByCodeName($data['province_id']),
            'city' => RegionModel::getIdByCodeName($data['city_id']),
            'region' => RegionModel::getIdByCodeName($data['region_id']),
        ];
    }
  
}
