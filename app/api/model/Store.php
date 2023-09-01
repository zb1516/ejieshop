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

namespace app\api\model;

use app\common\model\Store as StoreModel;
use think\model\relation\HasOne;

/**
 * 商家记录表模型
 * Class Store
 * @package app\store\model
 */
class Store extends StoreModel
{
    /**
     * 隐藏的字段
     * @var string[]
     */
    protected $hidden = [
        'sort',
        'is_recycle',
        'is_delete',
        'create_time',
        'update_time'
    ];

    /**
     * 关联logo图片
     * @return HasOne
     */
    public function logoImage(): HasOne
    {
        return $this->hasOne('UploadFile', 'file_id', 'logo_image_id')
            ->bind(['image_url' => 'preview_url']);
    }

    /**
     * 获取当前商城的基本信息
     * @return Store|array|null
     */
    public static function getInfo()
    {
        return static::detail(static::$storeId);
    }

    /**
     * 获取列表数据
     * @param bool $isRecycle
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function getList(array $storeIds , bool $isRecycle = false): \think\Paginator
    {
        return $this->where('store_id','in', $storeIds)->where('is_recycle', '=', (int)$isRecycle)
            ->where('is_delete', '=', 0)
            ->order(['create_time' => 'desc'])
            ->paginate(15);
    }
}
