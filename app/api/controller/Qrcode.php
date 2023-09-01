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

namespace app\api\controller;

use app\api\service\qrcode\QrcodeService;
use app\api\service\User as UserService;

/**
 * 我的邀请二维码
 */
class Qrcode extends Controller
{
    public function createQrcode()
    {
        //当前用户id
        $userId = UserService::getCurrentLoginUserId();

        return $this->renderSuccess([
            'user_qrcode' => (new QrcodeService())->getQrcode($userId), //用户邀请二维码
        ]);
    }
}
