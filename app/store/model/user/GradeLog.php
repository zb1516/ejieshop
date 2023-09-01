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

use app\common\model\user\GradeLog as GradeLogModel;

/**
 * 用户会员等级变更记录模型
 * Class GradeLog
 * @package app\store\model\user
 */
class GradeLog extends GradeLogModel
{
    /**
     * 新增变更记录
     * @param $data
     * @return int
     */
    public function record($data)
    {
        return $this->records([$data]);
    }

}