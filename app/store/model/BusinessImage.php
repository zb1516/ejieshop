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

namespace app\store\model;

use app\common\model\BusinessImage as BusinessImageModel;

/**
 * 门店图片模型
 * Class BusinessImage
 * @package app\store\model
 */
class BusinessImage extends BusinessImageModel
{
    /**
     * 批量写入商品图片记录
     * @param int $businessId
     * @param int $type 1:营业执照 2:商家门头照片(多张) 3:商家门店照片
     * @param array $imageIds
     * @return array|false
     */
    public static function increased(int $businessId, int $type, array $imageIds)
    {
        $dataset = [];
        foreach ($imageIds as $imageId) {
            $dataset[] = [
                'business_id' => $businessId,
                'type' => $type,
                'image_id' => $imageId,
                'store_id' => self::$storeId,
            ];
        }
        return (new static )->addAll($dataset);
    }

    /**
     * 删除关系记录
     * @param int $businessId
     * @return array|false
     */
    public static function deleteBusImage(int $businessId)
    {
        static::deleteAll(['business_id' => $businessId]);
    }
}
