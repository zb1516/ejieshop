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
declare (strict_types=1);

namespace app\admin\model;

use app\admin\model\UserOauth as UserOauthModel;
use app\common\model\User as UserModel;
use cores\exception\BaseException;

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

    /**
     * 获取用户信息
     * @param string $token
     * @return User|array|false|null
     * @throws BaseException
     */
    public static function getUserById(int $userId)
    {
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
}
