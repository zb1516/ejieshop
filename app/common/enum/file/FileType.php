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

namespace app\common\enum\file;

use app\common\enum\EnumBasics;

/**
 * 枚举类：文件类型
 * Class FileType
 * @package app\common\enum\goods
 */
class FileType extends EnumBasics
{
    // 图片
    const IMAGE = 10;

    // 附件
    const ANNEX = 20;

    // 视频
    const VIDEO = 30;

    /**
     * 获取枚举类型值
     * @return array
     */
    public static function data()
    {
        return [
            self::IMAGE => [
                'name' => '图片',
                'value' => self::IMAGE,
            ],
            self::ANNEX => [
                'name' => '附件',
                'value' => self::ANNEX,
                'preview_path' => 'assets/store/img/file_preview/video.png',
            ],
            self::VIDEO => [
                'name' => '视频',
                'value' => self::VIDEO,
                'preview_path' => 'assets/store/img/file_preview/video.png',
            ],
        ];
    }

}
