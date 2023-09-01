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

namespace app\api\service\recharge;

use app\api\model\MembeShipCardConfig;
use app\api\model\recharge\Order as OrderModel;
use app\api\model\User as UserModel;
use app\api\model\user\BalanceLog as BalanceLogModel;
use app\common\enum\recharge\order\PayStatus as PayStatusEnum;
use app\common\enum\user\balanceLog\Scene as SceneEnum;
use app\common\model\MembeShipCard;
use app\common\model\MembeShipCardLog;
use app\common\service\BaseService;

class PayUserCardSuccess extends BaseService
{
    // 订单模型
    public $model;

    // 当前用户信息
    private $user;

    /**
     * 构造函数
     * PaySuccess constructor.
     * @param $orderNo
     */
    public function __construct($orderNo)
    {
        parent::__construct();
        // 实例化订单模型
        $this->model = OrderModel::getPayDetail($orderNo);
        // 获取用户信息
        $this->user = UserModel::detail($this->model['user_id']);
    }

    /**
     * 获取订单详情
     * @return OrderModel|null
     */
    public function getOrderInfo()
    {
        return $this->model;
    }

    /**
     * 订单充值会员卡成功业务处理
     * @param int $payType 支付类型
     * @param array $payData 支付回调数据
     * @return bool
     */
    public function onPaySuccess(int $payType, $payData)
    {
        return $this->model->transaction(function () use ($payData) {
            // 更新订单状态
            $this->model->save([
                'pay_status' => PayStatusEnum::SUCCESS,
                'pay_time' => time(),
                'transaction_id' => $payData['transaction_id'],
            ]);

            $cardInfo = MembeShipCardConfig::detail($this->model->card_id);
            //允许充值到余额
            if ($cardInfo['is_recharge'] == 1) {
                // 累积用户余额
                UserModel::setIncBalance((int) $this->user['user_id'], (float) $this->model['actual_money']);
                // 用户余额变动明细
                BalanceLogModel::add(SceneEnum::RECHARGECARD, [
                    'user_id' => $this->user['user_id'],
                    'money' => $this->model['actual_money'],
                    'store_id' => $this->getStoreId(),
                ], ['order_no' => $this->model['order_no']]);
            }
            //添加用户会员卡记录
            $model = new MembeShipCard;
            $validity_month = $cardInfo['validity_month'] - 1;
            $deadline_time = strtotime("+{$validity_month} month");
            $data = [
                'membership_card_id' => $cardInfo['id'],
                'user_id' => $this->model['user_id'],
                'name' => $cardInfo['name'],
                'validity_month' => $cardInfo['validity_month'],
                'discount' => $cardInfo['discount'],
                'equity_goods_id' => $cardInfo['equity_goods_id'],
                'gift_goods_id' => $cardInfo['gift_goods_id'],
                'equity_remark' => $cardInfo['equity_remark'],
                'gift_remark' => $cardInfo['gift_remark'],
                'deadline_time' => $deadline_time,
            ];
            if ($model->save($data)) {
                $cardModel = new MembeShipCardLog;
                //添加会员权益领取记录
                $cardLog = [];
                $membership_card_id = $model->getLastInsID();
                if ($cardInfo['equity_goods_id'] > 0) {
                    for ($i = 0; $i < $cardInfo['validity_month']; $i++) {
                        $cardLog[] = [
                            'user_membership_card_id' => $membership_card_id,
                            'user_id' => $this->model['user_id'],
                            'membership_card_id' => $cardInfo['id'],
                            'type' => 1,
                            'create_time' => time(),
                            'update_at' => time(),
                            'receive_time' => strtotime("+{$i} month"),
                        ];
                    }
                    $cardModel->insertAll($cardLog);
                }
                if ($cardInfo['gift_goods_id'] > 0) {
                    $cardLog = [
                        'user_membership_card_id' => $membership_card_id,
                        'user_id' => $this->model['user_id'],
                        'membership_card_id' => $cardInfo['id'],
                        'type' => 2,
                        'receive_time' => $deadline_time,
                    ];
                    $cardModel->save($cardLog);
                }
            }
            return true;
        });
    }

}
