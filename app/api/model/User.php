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

use think\facade\Cache;
use app\api\service\User as UserService;
use app\api\model\UserOauth as UserOauthModel;
use app\common\model\User as UserModel;
use cores\exception\BaseException;
use yiovo\captcha\facade\CaptchaApi;
use app\api\model\user\ApplyLog as ApplyLogModel;

/**
 * 用户模型类
 * Class User
 * @package app\api\model
 */
class User extends UserModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'open_id',
        'is_delete',
        'store_id',
        'create_time',
        'update_time'
    ];

    const IS_WITH_DRAWL = 1;

    /**
     * 获取器：隐藏手机号中间四位
     * @param string $value
     * @return string
     */
    public function getMobileAttr(string $value): string
    {
        return strlen($value) === 11 ? hide_mobile($value) : $value;
    }

    /**
     * 获取用户信息
     * @param string $token
     * @return User|array|false|null
     * @throws BaseException
     */
    public static function getUserByToken(string $token)
    {
        // 检查登录态是否存在
        if (!Cache::has($token)) {
            return false;
        }
        // 用户的ID
        $userId = (int)Cache::get($token)['user']['user_id'];
        // 用户基本信息
        $userInfo = self::detail($userId);
        if (empty($userInfo) || $userInfo['is_delete']) {
            throwError('很抱歉，用户信息不存在或已删除', config('status.not_logged'));
        }
        // 获取用户关联的第三方用户信息(当前客户端)
        try {
            $userInfo['currentOauth'] = UserOauthModel::getOauth($userId, getPlatform());
        } catch (\Throwable $e) {
            throwError($e->getMessage());
        }
        return $userInfo;
    }

    /**
     * 绑定手机号(当前登录用户)
     * @param array $data
     * @return bool
     * @throws BaseException
     */
    public function bindMobile(array $data): bool
    {
        // 当前登录的用户信息
        $userInfo = UserService::getCurrentLoginUser(true);
        // 验证绑定的手机号
        $this->checkBindMobile($data);
        // 更新手机号记录
        return $userInfo->save(['mobile' => $data['mobile']]);
    }

    /**
     * 验证绑定的手机号
     * @param array $data
     * @return void
     * @throws BaseException
     */
    private function checkBindMobile(array $data): void
    {
         // 验证短信验证码是否匹配
         if(TP_ENV == 'dev' && $data['smsCode'] == '6666'){
            return;
        }
        // 验证短信验证码是否匹配
        if (!CaptchaApi::checkSms($data['smsCode'], $data['mobile'])) {
            throwError('短信验证码不正确');
        }
        // 判断手机号是否已存在
        if (static::checkExistByMobile($data['mobile'])) {
            throwError('很抱歉，该手机号已绑定其他账户');
        }
    }

    /**
     * 用户提现状态
     * @param string $token
     * @return bool
     * @throws BaseException
     */
    public function withDrawlStatus()
    {
        // 当前登录的用户信息
        $userInfo = UserService::getCurrentLoginUser(true);
        //判断是否可以提现
        if (self::IS_WITH_DRAWL == $userInfo['is_with_drawl']){
            return true;
        }
        return false;
    }

    /**
     * 更新用户冻结金额
     * @param float $frozenMoney
     * @param float $money
     * @return bool
     * @throws BaseException
     */
    public function updateBalance(string $frozenMoney , string $money)
    {
        // 当前登录的用户id
        $userId = UserService::getCurrentLoginUserId();
        $data=[
            'frozen_balance' => $frozenMoney,
            'balance' => $money
        ];
        return $this->where('user_id','=',$userId)->save($data);
    }
}
