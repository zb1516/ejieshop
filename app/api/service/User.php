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

namespace app\api\service;

use app\api\model\Commission;
use app\api\model\Goods;
use app\api\model\User as UserModel;
use app\api\model\UserOauth as UserOauthModel;
use app\common\library\helper;
use app\common\model\MembeShipCard;
use app\common\service\BaseService;
use cores\exception\BaseException;

/**
 * 用户服务类
 * Class User
 * @package app\api\service
 */
class User extends BaseService
{
    // 当前登录的会员信息
    private static $currentLoginUser;

    /**
     * 获取当前登录的用户信息 (快捷)
     * 可在api应用中的任意模块中调用此方法(controller model service)
     * 已登录情况下返回用户信息, 未登录返回false
     * @param bool $isForce 是否强制验证登录, 如果未登录将抛错
     * @return false|UserModel
     * @throws BaseException
     */
    public static function getCurrentLoginUser(bool $isForce = false)
    {
        $service = new static;
        if (empty(static::$currentLoginUser)) {
            static::$currentLoginUser = $service->getLoginUser();
            if (empty(static::$currentLoginUser)) {
                $isForce && throwError($service->getError(), config('status.not_logged'));
                return false;
            }
        }
        return static::$currentLoginUser;
    }

    /**
     * 获取当前登录的用户ID
     * getCurrentLoginUser方法的二次封装
     * @return mixed
     * @throws BaseException
     */
    public static function getCurrentLoginUserId()
    {
        $userInfo = static::getCurrentLoginUser(true);
        return $userInfo['user_id'];
    }
  

    /**
     * 获取第三方用户信息
     * @param int $userId 用户ID
     * @param string $oauthType 第三方登陆类型
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getOauth(int $userId, $oauthType = 'MP-WEIXIN')
    {
        return UserOauthModel::getOauth($userId, $oauthType);
    }

    /**
     * 验证是否已登录
     * @param bool $isForce 是否强制验证登录, 如果未登录将抛错
     * @return bool
     * @throws BaseException
     */
    public static function isLogin(bool $isForce = false)
    {
        return !empty(static::getCurrentLoginUser($isForce));
    }

    /**
     * 获取当前登录的用户信息
     * @return UserModel|array|false|null
     * @throws BaseException
     */
    private function getLoginUser()
    {
        // 获取用户认证Token
        if (!$token = $this->getToken()) {
            return false;
        }
        // 获取用户信息
        if (!$user = UserModel::getUserByToken($token)) {
            $this->error = '没有找到用户信息';
            return false;
        }
        return $user;
    }

    /**
     * 获取用户认证Token
     * @return bool|string
     */
    protected function getToken()
    {
        // 获取请求中的token
        $token = $this->request->header('Access-Token');
        // 调试模式下可通过param
        if (empty($token) && is_debug()) {
            $token = $this->request->param('Access-Token');
        }
        // 不存在token报错
        if (empty($token)) {
            $this->error = '缺少必要的参数token, 请先登录';
            return false;
        }
        return $token;
    }
    /**
     * 验证是否购买过当前会员卡
     * @param int $membership_card_id 会员卡ID
     * @return bool
     * @throws BaseException
     */
    public static function checkusercard(int $membership_card_id)
    {
        $where = [
            ['membership_card_id', '=', $membership_card_id],
            ['user_id', '=', self::getCurrentLoginUserId()],
            ['deadline_time', '>', time()],
        ];
        $usercard = MembeShipCard::detail($where);
        if (!empty($usercard)) {
            throwError("您已购买过此会员卡,请勿重复购买");
        }
        return [];
    }
    /**
     * 验证是否购买过当前会员卡
     * @return array
     * @throws BaseException
     */
    public static function equityList()
    {
        $list = MembeShipCard::getList(self::getCurrentLoginUserId());
        if (empty($list)) {
            throwError("暂未购买会员卡");
        }
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
        $goodsIds = helper::getArrayColumn($list, 'equity_goods_id');
        $goodsIds = array_merge($goodsIds, helper::getArrayColumn($list, 'gift_goods_id'));
        $model = new Goods();
        $goodsList = $model->getListByIdsFromApi($goodsIds)->toArray();
        if (!empty($goodsList)) {
            $goodsList = array_column($goodsList, null, 'goods_id');
        }
        $now = time();
        // 遍历商品列表整理数据
        foreach ($list as &$menbership) {
            $menbership['equity_goods_name'] = $goodsList[$menbership['equity_goods_id']]['goods_name'] ?? ''; //权益商品名
            $menbership['equity_goods_image'] = $goodsList[$menbership['equity_goods_id']]['goods_image'] ?? ''; //权益商品图片地址
            $menbership['gift_goods_name'] = $goodsList[$menbership['gift_goods_id']]['goods_name'] ?? ''; //赠品名称
            $menbership['gift_goods_image'] = $goodsList[$menbership['gift_goods_id']]['goods_image'] ?? ''; //赠品图片地址
            $menbership['usercardlog'] = $menbership->usercardlog;
            if (!empty($menbership['usercardlog'])) {
                foreach ($menbership['usercardlog'] as &$usercardlog) {
                    //到日期才能进行领取
                    $usercardlog['goods_status'] = 1; //1不可领取 0可领取
                    if ($now > $usercardlog['receive_time']) {
                        $usercardlog['goods_status'] = 0; //1不可领取 0可领取
                    }
                    //已领取过的展示不可领取
                    if ($usercardlog['status'] == 1) {
                        $usercardlog['goods_status'] = 1;
                    }
                    unset($usercardlog['status']);
                }
            }
        }
        return $list;
    }
    /**
     * 会员卡最低折扣
     *
     * @return string
     */
    public static function getMinDiscount()
    {
        $userInfo = static::getCurrentLoginUser();
        if(empty($userInfo)){
            return '1';
        }
        $discount = MembeShipCard::where(['user_id' => $userInfo['user_id']])->min('discount');
        if(empty($discount)){
            return '1';
        }
        return (string) $discount;
    }
    /**
     * 会员卡最高分润比例
     * @param  string price 订单实付金额
     * @return string
     */
    public static function getMaxCommission(string $price)
    {
        $result = ['refereeId' => 0, 'refree_price' => 0];
        $userInfo = static::getCurrentLoginUser();
        //未登录
        if(empty($userInfo)){   
            return $result;
        }
        //没有邀请人
        if($userInfo['refereeId'] == 0){
            return $result;
        }
        $commission = MembeShipCard::where(['user_id' => $userInfo['user_id']])->max('commission');
        if(empty($commission)){
            $commission = Commission::where(['scale_name' => 'referee'])->value('scale_value');
        }
        $result['refereeId'] = $userInfo['refereeId'];
        $result['refree_price'] = bcmul((string) $commission, $price, 2);
        return $result;
    }
}
