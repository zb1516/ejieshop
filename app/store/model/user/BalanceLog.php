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

namespace app\store\model\user;

use app\common\enum\user\balanceLog\Scene as SceneEnum;
use app\common\model\user\BalanceLog as BalanceLogModel;

/**
 * 用户余额变动明细模型
 * Class BalanceLog
 * @package app\store\model\user
 */
class BalanceLog extends BalanceLogModel
{
    // 提现
    const LIST_TYPE_WITHDRAWAL = 'withdrawal';

    // 返佣
    const LIST_TYPE_COMMISSION = 'commission';

    /**
     * 获取余额变动明细列表
     * @param array $param
     * @return \think\Paginator
     */
    public function getList(array $param = [])
    {
        // 设置查询条件
        $filter = $this->getFilter($param);
        // 获取列表数据
        return $this->with(['user.avatar'])
            ->alias('log')
            ->field('log.*')
            ->where($filter)
            ->join('user', 'user.user_id = log.user_id')
            ->order(['log.create_time' => 'desc'])
            ->paginate(15);
    }

    /**
     * 设置查询条件
     * @param array $param
     * @return array
     */
    private function getFilter(array $param): array
    {
        // 设置默认的检索数据
        $params = $this->setQueryDefaultValue($param, [
            'user_id' => 0,         // 用户ID
            'search' => '',         // 用户昵称
            'scene' => 0,           // 余额变动场景
            'betweenTime' => []    // 起止时间
        ]);
        // 检索查询条件
        $filter = [];
        // 用户ID
        $params['user_id'] > 0 && $filter[] = ['log.user_id', '=', $params['user_id']];
        // 用户昵称
        !empty($params['search']) && $filter[] = ['user.nick_name', 'like', "%{$params['search']}%"];
        // 余额变动场景
        $params['scene'] > 0 && $filter[] = ['log.scene', '=', (int)$params['scene']];
        // 起止时间
        if (!empty($params['betweenTime'])) {
            $times = between_time($params['betweenTime']);
            $filter[] = ['log.create_time', '>=', $times['start_time']];
            $filter[] = ['log.create_time', '<', $times['end_time'] + 86400];
        }
        return $filter;
    }

    /**
     * 用户提现增加账户余额变动记录
     * @return void
     * @throws \cores\exception\BaseException
     */
    public function withDrawl(int $scene, array $data, array $describeParam):bool
    {
        $model = new static;
        return $this->save(array_merge([
            'scene'=>$scene,
            'describe'=>vsprintf(SceneEnum::data()[$scene]['describe'], $describeParam),
            'store_id' => $model::$storeId
        ],$data));
    }

    /**
     * 获取当前返佣总额
     * @param array $where
     * @return int
     */
    public function getBalanceTotal(array $where = [])
    {
       return $this->where($where)->sum("money");
    }

    /**
     * 获取返佣列表
     * @param array $param
     * @return mixed
     */
    public function getBalanceList(array $param = [])
    {
        // 设置查询条件
        $filter = $this->getQueryFilter($param);
        // 获取列表数据
        return $this->with(['user.avatar'])
            ->alias('log')
            ->field('log.*,user.mobile,user.nick_name')
            ->where($filter)
            ->where('log.scene', '=', 50)
            ->join('user', 'user.user_id = log.user_id')
            ->order(['log.create_time' => 'desc'])
            ->paginate(15);
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
            'mobile' => '',      //手机号
            'orderNo' =>'',     //订单号
            'betweenTime' => [], //起止时间
        ]);
        // 检索查询条件
        $filter = [];
        // 手机号
        if (!empty($params['mobile'])) {
            $filter[] = ['user.mobile', 'like', "%{$params['mobile']}%"];
        }
        if (!empty($params['orderNo'])) {
            $filter[] = ['log.describe', 'like', "%{$params['orderNo']}%"];
        }
        // 起止时间
        if (!empty($params['betweenTime'])) {
            $times = between_time($params['betweenTime']);
            $filter[] = ['log.create_time', '>=', $times['start_time']];
            $filter[] = ['log.create_time', '<', $times['end_time'] + 86400];
        }
        return $filter;
    }
}
