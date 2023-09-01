<?php
// +----------------------------------------------------------------------
// | 易捷商城系统 [ 致力于通过产品和服务，帮助商家高效化开拓市场 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017~2021 https://www.yiovo.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed 这不是一个自由软件，不允许对程序代码以任何形式任何目的的再发行
// +----------------------------------------------------------------------
// | Author: 萤火科技 <admin@yiovo.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace app\store\model\user;

use app\common\model\user\ApplyLog as ApplyLogModel;

/**
 * 用户提现申请模型
 * Class Menu
 * @package app\admin\model\store
 */
class ApplyLog extends ApplyLogModel
{
    /**
     * 获取列表数据
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function getList(array $params): \think\Paginator
    {
        // 检索查询条件
        $filter = $this->getQueryFilter($params);
        return $this
            ->alias('apply')
            ->field('apply.*,user.nick_name,user.mobile')
            ->join('user', 'user.user_id = apply.user_id')
            ->where($filter)
            ->where('apply.is_delete', '=', 0)
            ->order(['apply.create_time' => 'desc'])
            ->paginate(15);
    }

    /**
     * 通过id查询一条数据
     * @param int $id
     * @return array
     */
    public function detail(int $id)
    {
        return $this->get($id);
    }

    /**
     * 修改
     * @param array $data
     * @return void
     */
    public function edit(int $userId = 0,int $status = 1, string $remark = ''):bool
    {
        $data = [];
        if (!empty($remark)) $data['remark'] = $remark;
        if (!empty($status)) $data['aduit_status'] = $status;
        $this->where('user_id','=',$userId)->save($data);
        return true;
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
            'mobile' => '',     // 手机号
            'cardNo' => '',    // 银行卡号
            'aduitStatus' => 0,  // 审核状态
            'betweenTime' => [],    // 起止时间
        ]);
        // 检索查询条件
        $filter = [];
        // 手机号
        if (!empty($params['mobile'])) {
            $filter[] = ['user.mobile', '=', $params['mobile']];
        }
        // 银行卡号
        if (!empty($params['cardNo'])) {
            $filter[] = ['apply.card_no', '=', $params['cardNo']];
        }
        //审核状态
        if ($params['aduitStatus'] != -1) {
            $filter[] = ['apply.aduit_status', '=', $params['aduitStatus']];
        }
        // 起止时间
        if (!empty($params['betweenTime'])) {
            $times = between_time($params['betweenTime']);
            $filter[] = ['apply.create_time', '>=', $times['start_time']];
            $filter[] = ['apply.create_time', '<', $times['end_time'] + 86400];
        }
        return $filter;
    }
}
