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

namespace app\store\model;

use app\admin\model\store\User;
use app\common\model\Business as BusinessModel;
use app\common\model\store\UserRole;
use app\store\model\BusinessImage as BusinessImageModel;

/**
 * 商家用户模型
 * Class StoreUser
 * @package app\admin\model
 */
class Business extends BusinessModel
{
    /**
     * 详情记录
     * @param int $id 门店ID
     * @return array|static|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function detail(int $id)
    {
        return (new static )->where('id', '=', $id)->find();
    }
    /**
     * 门店列表
     *
     * @param array $data
     * @return void
     */
    public static function storeList(array $param)
    {
        //检索查询条件
        $filter = (new self)->getQueryFilter($param);
        $model = (new static );
        // 关联查询
        $list = $model->where($filter)->with(['images.file'])->order(['id' => 'desc'])->paginate(20);
        // 整理列表数据并返回
        return (new self)->setBusListData($list);
    }
    /**
     * 关联门店图片表
     * @return \think\model\relation\HasMany
     */
    public function images()
    {
        return $this->hasMany('BusinessImage')->order(['id']);
    }

    /**
     * 设置门店展示的数据
     * @param Collection|Paginator $list 商品列表
     * @param callable|null $callback 回调函数
     * @return mixed
     */
    protected function setBusListData($list, callable $callback = null)
    {
        if ($list->isEmpty()) {
            return $list;
        }

        // 遍历商品列表整理数据
        foreach ($list as &$business) {
            $business = $this->setBussData($business, $callback);
        }
        return $list;
    }
    /**
     * 整理门店数据
     * @param Collection|static $businessInfo
     * @param callable|null $callback
     * @return mixed
     */
    protected function setBussData($businessInfo, callable $callback = null)
    {
        $business_license = []; //1营业执照
        $door_head_photo = []; //2:商家门头照片(多张)
        $store_photos = []; //3:商家门店照片
        foreach ($businessInfo['images']->toArray() as $value) {
            if ($value['type'] == 1) {
                $business_license[] = $value['file'];
            } elseif ($value['type'] == 2) {
                $door_head_photo[] = $value['file'];
            } else {
                $store_photos[] = $value['file'];
            }
        }
        $businessInfo['business_license_list'] = $business_license;
        $businessInfo['door_head_photo_list'] = $door_head_photo;
        $businessInfo['store_photos_list'] = $store_photos;
        $businessInfo['business_license'] = !empty($business_license) ? array_column($business_license, 'file_id') : [];
        $businessInfo['door_head_photo'] = !empty($door_head_photo) ? array_column($door_head_photo, 'file_id') : [];
        $businessInfo['store_photos'] = !empty($store_photos) ? array_column($store_photos, 'file_id') : [];
        // 回调函数
        is_callable($callback) && call_user_func($callback, $businessInfo);
        return $businessInfo->hidden(array_merge($this->hidden, ['images']));
    }
    /**
     * 设置检索查询条件
     * @param array $param
     * @return array
     */
    private function getQueryFilter(array $param): array
    {
        // 默认参数
        $params = $this->setQueryDefaultValue($param, [
            'searchType' => '', // 关键词类型 (10手机号 20门店名称 30商家姓名)
            'searchValue' => '', // 关键词内容
            'region_id' => -1, // 区code
            'status' => -1, // 门店状态
        ]);
        // 检索查询条件
        $filter[] = ['is_delete', '=', 0];
        // 关键词
        if (!empty($params['searchValue'])) {
            $searchWhere = [
                10 => ['mobile', 'like', "%{$params['searchValue']}%"],
                20 => ['title', 'like', "%{$params['searchValue']}%"],
                30 => ['merchant_name', 'like', "%{$params['searchValue']}%"],
                40 => ['store_user_name', 'like', "%{$params['searchValue']}%"],
            ];
            array_key_exists($params['searchType'], $searchWhere) && $filter[] = $searchWhere[$params['searchType']];
        }
        // 起止时间
        if (!empty($params['betweenTime'])) {
            $times = between_time($params['betweenTime']);
            $filter[] = ['create_at', '>=', $times['start_time']];
            $filter[] = ['create_at', '<', $times['end_time'] + 86400];
        }
        // 区code
        $params['region_id'] > -1 && $filter[] = ['region_id', '=', (int) $params['region_id']];
        // 门店状态
        $params['status'] > -1 && $filter[] = ['status', '=', (int) $params['status']];

        return $filter;
    }
    /**
     * 验证门店管理员
     *
     * @return void
     */
    private function checkStoreUser(array $data, int $businessId = 0)
    {
        //验证管理员是不是门店管理员
        $store_user = UserRole::get(['store_user_id' => $data['store_user_id']]);
        if (empty($store_user)) {
            throwError('管理员id不存在');
        }
        if ($store_user->role_id != 10004) {
            throwError('管理员角色必须为门店管理');
        }
        if ($businessId == 0) { //添加
            $business = static::get(['store_user_id' => $data['store_user_id'], 'is_delete' => 0]);
            if (!empty($business)) {
                throwError('门店管理员已绑定，请勿重复操作');
            }
        } else { //编辑
            $count = static::where(['store_user_id' => $data['store_user_id'], 'is_delete' => 0])->where('id', '<>', $businessId)->count();
            if ($count > 0) {
                throwError('门店管理员已绑定，请勿重复操作');
            }
        }

    }
    /**
     * 添加门店
     * @param array $data
     * @return bool
     * @throws \cores\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add(array $data): bool
    {
        $this->checkStoreUser($data);
        // 创建门店数据
        if($data['store_user_id']){
            $data['store_user_name'] = User::where(['store_user_id' => $data['store_user_id']])->value('user_name');
        }
        
        // 事务处理
        $this->transaction(function () use ($data) {
            // 添加商品
            $this->save($data);
            // 新增门店与图片关联
            if (isset($data['business_license']) && !empty($data['business_license'])) {
                BusinessImageModel::increased((int) $this['id'], 1, $data['business_license']);
            }
            if (isset($data['door_head_photo']) && !empty($data['door_head_photo'])) {
                BusinessImageModel::increased((int) $this['id'], 2, $data['door_head_photo']);
            }
            if (isset($data['store_photos']) && !empty($data['store_photos'])) {
                BusinessImageModel::increased((int) $this['id'], 3, $data['store_photos']);
            }
        });
        return true;
    }

    /**
     * 编辑门店
     * @param array $data
     * @return bool
     * @throws \cores\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit(array $data, $businessId): bool
    {
        $this->checkStoreUser($data, $businessId);
        // 编辑门店数据
        if($data['store_user_id']){
            $data['store_user_name'] = User::where(['store_user_id' => $data['store_user_id']])->value('user_name');
        }
        // 事务处理
        $this->transaction(function () use ($data) {
            // 更新门店
            $this->save($data);
            // 更新门店与图片关联
            BusinessImageModel::deleteBusImage($this['id']);
            if (isset($data['business_license']) && !empty($data['business_license'])) {
                BusinessImageModel::increased((int) $this['id'], 1, $data['business_license']);
            }
            if (isset($data['door_head_photo']) && !empty($data['door_head_photo'])) {
                BusinessImageModel::increased((int) $this['id'], 2, $data['door_head_photo']);
            }
            if (isset($data['store_photos']) && !empty($data['store_photos'])) {
                BusinessImageModel::increased((int) $this['id'], 3, $data['store_photos']);
            }
        });
        return true;
    }
    /**
     * 删除记录
     * @return bool|int
     */
    public function remove()
    {
        return $this->save(['is_delete' => 1]);
    }
    /**
     * 根据管理员ID查看门店ID
     *
     * @param [type] $store_user_id
     * @return void
     */
    public static function getBusinessId($store_user_id)
    {
        return static::where(['store_user_id' => $store_user_id, 'is_delete' => 0])->value('id');
    }
}
