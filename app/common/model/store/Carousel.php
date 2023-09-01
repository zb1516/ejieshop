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

namespace app\common\model\store;

use cores\BaseModel;

/**
 * 轮播图模型
 * Class Address
 * @package app\common\model\store
 */
class Carousel extends BaseModel
{
    // 定义表名
    protected $name = 'carousel';

    // 定义主键
    protected $pk = 'carousel_id';


    /**
     * 关联文章封面图
     * @return \think\model\relation\HasOne
     */
    public function image()
    {
        return $this->hasOne('app\\store\\model\\UploadFile', 'file_id', 'image_id')
            ->bind(['image_url']);
    }

    /**
     * 详情记录
     * @param int $carouselId
     * @return null|static
     */
    public static function detail(int $carouselId)
    {
        return self::get($carouselId);
    }
}
