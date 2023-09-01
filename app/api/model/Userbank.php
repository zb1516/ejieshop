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

namespace app\api\model;

use app\common\model\Userbank as UserbankModel;

class Userbank extends UserbankModel
{
    /**
     * 获取列表
     * @param int $use_id
     * @return void
     */
    public static function getList(int $user_id)
    {
        return (new static )->where('user_id', '=', $user_id)
            ->where('is_delete', '=', 0)
            ->order(['create_at' => 'desc'])
            ->select();
    }
    /**
     * 详情记录
     * @param int $id 银行卡ID
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
     * 添加银行卡
     * @param array $data
     * @return bool
     * @throws \cores\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add(array $data): bool
    {
        // 创建银行卡数据
        $count = $this->where(['user_id' => $data['user_id'], 'is_delete' => 0])->count();
        if ($count >= 5) {
            throwError('绑定银行卡不能超过5张');
        }
        // 事务处理
        $this->transaction(function () use ($data) {
            // 添加商品
            $this->save($data);
        });
        return true;
    }
    /**
     * 编辑银行卡
     * @param array $data
     * @return bool
     * @throws \cores\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit(array $data): bool
    {
        // 事务处理
        $this->transaction(function () use ($data) {
            // 更新门店
            $this->save($data);

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
     * 设置默认银行卡
     * @return bool|int
     */
    public function isused($user_id)
    {
        $this::update(['is_used' => 0], ['user_id' => $user_id]);
        return $this->save(['is_used' => 1]);
    }

    /**
     * 用户银行卡信息
     * @param int $userId
     * @param int $isUsed
     * @return Userbank|array|mixed|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUsedBankDetail(int $userId)
    {
        return $this
            ->where('user_id','=',$userId)
            ->where('is_used','=',1)
            ->where('is_delete','=',0)
            ->find();
    }
}
