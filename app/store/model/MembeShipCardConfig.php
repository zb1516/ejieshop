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

use app\common\model\MembeShipCardConfig as MembeShipCardConfigModel;

/**
 * 会员卡模型
 * Class MembeShipCardConfig
 * @package app\store\model
 */
class MembeShipCardConfig extends MembeShipCardConfigModel
{
    /**
     * 详情记录
     * @param int $id 会员卡ID
     * @return array|static|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function detail(int $id)
    {
        return (new static)->where('id', '=', $id)->find();
    }
    /**
     * 会员卡列表
     *
     * @return void
     */
    public static function list()
    {
        //检索查询条件
        $list = (new static)->where(['is_delete' => 0])->order('sort asc, id desc')->paginate(1500);
        
        // 整理列表数据并返回
        return (new self)->setMenbershipListData($list);
    }

     /**
     * 设置会员卡展示的数据
     * @param Collection|Paginator $list 会员卡列表
     * @return mixed
     */
    protected function setMenbershipListData($list)
    {
        if ($list->isEmpty()) {
            return $list;
        }
        // 遍历商品列表整理数据
        foreach ($list as &$menbership) {
            $menbership['image_list'] = [$menbership->file];
            $menbership['image_id'] = [$menbership->image_id];
            $menbership['equity_goods_id'] = [$menbership->equity_goods_id];
            $menbership['gift_goods_id'] = [$menbership->gift_goods_id];
            unset($menbership['file']);
        }
        return $list;
    }
 
    /**
     * 添加会员卡
     * @param array $data
     * @return bool
     * @throws \cores\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add(array $data): bool
    {
        // 创建会员卡数据
        // 事务处理
        $this->transaction(function () use ($data) {
            // 添加商品
            $this->save($data);
        });
        return true;
    }

    /**
     * 编辑会员卡
     * @param array $data
     * @return bool
     * @throws \cores\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit(array $data): bool
    {
        // 编辑门店数据
        
        // 事务处理
        $this->transaction(function () use ($data) {
            // 更新门店
            $this->save($data);
            
        });
        return true;
    }
    /**
     * 删除会员卡
     * @return bool|int
     */
    public function remove()
    {
        return $this->save(['is_delete' => 1]);
    }
}
