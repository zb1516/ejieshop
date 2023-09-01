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

namespace app\store\model\store;

use app\common\model\store\UserRole as UserRoleModel;

/**
 * 商家用户角色模型
 * Class UserRole
 * @package app\store\model\store
 */
class UserRole extends UserRoleModel
{
    /**
     * 新增关系记录
     * @param int $storeUserId
     * @param array $roleIds
     * @return array|false
     */
    public static function increased(int $storeUserId, array $roleIds)
    {
        $data = [];
        foreach ($roleIds as $roleId) {
            $data[] = [
                'store_user_id' => $storeUserId,
                'role_id' => $roleId,
                'store_id' => self::$storeId,
            ];
        }
        return (new static )->addAll($data);
    }

    /**
     * 更新关系记录
     * @param int $storeUserId
     * @param array $newRoles 新的角色集
     * @return array|false
     * @throws \Exception
     */
    public static function updates(int $storeUserId, array $newRoles)
    {
        // 已分配的角色集
        $assignRoleIds = self::getRoleIdsByUserId($storeUserId);
        // 找出删除的角色
        $deleteRoleIds = array_diff($assignRoleIds, $newRoles);
        if (!empty($deleteRoleIds)) {
            self::deleteAll([
                ['store_user_id', '=', $storeUserId],
                ['role_id', 'in', $deleteRoleIds],
            ]);
        }
        // 找出添加的角色
        $newRoleIds = array_diff($newRoles, $assignRoleIds);
        $data = [];
        foreach ($newRoleIds as $roleId) {
            $data[] = [
                'store_user_id' => $storeUserId,
                'role_id' => $roleId,
                'store_id' => self::$storeId,
            ];
        }
        return (new static )->addAll($data);
    }

    /**
     * 获取指定管理员的所有角色id
     * @param int $storeUserId
     * @return array
     */
    public static function getRoleIdsByUserId(int $storeUserId)
    {
        return (new static )->where('store_user_id', '=', $storeUserId)->column('role_id');
    }

    /**
     * 根据角色ID判断是否存在用户
     * @param int $roleId
     * @return bool
     */
    public static function isExistsUserByRoleId(int $roleId)
    {
        return !!(new static )->where('role_id', '=', $roleId)->count();
    }
    /**
     * 门店管理员 列表
     * @param array $param
     * @return mixed
     */
    public static function getList(array $param = [])
    {
        // 获取数据列表
        $model = (new static)->alias('user_role')
            ->leftJoin('store_user', 'store_user.store_user_id = user_role.store_user_id')
            ->where('user_role.role_id', '=', 10004);
        if(isset($param['name'])) {
            $model->where('store_user.user_name', 'like', "%" . $param['name'] . "%");
        }
        return $model->field('store_user.store_user_id, store_user.user_name')->order(['store_user.store_user_id' => 'desc'])->select()->toArray();
    }
     /**
     * 已绑定的门店管理员 列表
     * @param array $param
     * @return mixed
     */
    public static function storebindUserlist(array $param = [])
    {
        // 获取数据列表
        $model = (new static)->alias('user_role')
            ->leftJoin('store_user', 'store_user.store_user_id = user_role.store_user_id')
            ->leftJoin('business', 'business.store_user_id = user_role.store_user_id')
            ->where('user_role.role_id', '=', 10004)
            ->where('business.status', '=', 1)
            ->where('business.store_user_id', '>', 0);
        
        if(isset($param['store_user_id'])) {
            $model->where('store_user.store_user_id', '=', $param['store_user_id']);
        }
        return $model->field('business.id as business_id, store_user.user_name, business.title')->order(['store_user.store_user_id' => 'desc'])->select()->toArray();
    }
}
