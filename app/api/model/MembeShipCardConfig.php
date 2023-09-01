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

use app\api\service\User;
use app\common\model\MembeShipCardConfig as MembeShipCardConfigModel;

/**
 * 会员卡权益配置模型
 * Class MembeShipCardConfig
 * @package app\api\model\recharge
 */
class MembeShipCardConfig extends MembeShipCardConfigModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'sort',
        'is_delete',
        'create_time',
        'update_time',
    ];

    /**
     * 查询
     * @return MembershipCardConfig[]|array|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getList()
    {
        $user_id = User::getCurrentLoginUserId();
        $list = (new static )->alias('a')
            ->field('a.*,b.deadline_time')
            ->leftJoin('user_membership_card b', 'a.id = b.membership_card_id and b.user_id = ' . $user_id)->where('a.is_delete', '=', 0)->select();
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
            $menbership['is_buy'] = !empty($menbership['deadline_time']) && $menbership['deadline_time'] > time() ? 1 : 0;            
            $menbership['deadline_time'] = !empty($menbership['deadline_time']) && $menbership['deadline_time'] > time() ? $menbership['deadline_time'] : '';
            $menbership['preview_url'] = $menbership->file['preview_url'];
            unset($menbership['file']);
        }
        return $list;
    }
    /**
     * 根据自定义充值金额匹配满足的会员卡
     * @param $payPrice
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getMatchPlan($payPrice)
    {
        return (new static )->where('money', '<=', $payPrice)
            ->where('is_delete', '=', 0)
            ->find();
    }
    /**
     * 会员卡详情
     * @param $id
     * @return null|static
     */
    public static function detail($id)
    {
        return self::get($id);
    }
}
