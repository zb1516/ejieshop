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

namespace app\store\model\store;

use app\common\model\store\Carousel as CouselModel;

/**
 * 轮播图模型
 * Class Menu
 * @package app\admin\model\store
 */
class Carousel extends CouselModel
{

    /**
     * 获取轮播列表
     * @param int $categoryId
     * @param int $limit
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function getList(array $param = [], int $limit = 15)
    {
        // 检索查询条件
        $params = $this->setQueryDefaultValue($param, [
            'carousel_title' => '',    // 幻灯片标题
        ]);
        $filter=[];
        // 幻灯片标题
        !empty($params['carousel_title']) && $filter[] = ['carousel_title', 'like', "%{$params['carousel_title']}%"];
        // 获取列表数据
        return $this->where($filter)
            ->where('is_delete', '=', 0)
            ->order(['sort' => 'asc', 'create_time' => 'desc'])
            ->paginate($limit);
    }

    /**
     * 新增记录
     * @param $data
     * @return false|int
     */
    public function add(array $data)
    {
        if (empty($data['image_id'])) {
            $this->error = '请上传封面图';
            return false;
        }
        $data['store_id'] = self::$storeId;
        return $this->save($data);
    }

    /**
     * 更新记录
     * @param array $data
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit(array $data)
    {
        return $this->save($data) !== false;
    }


    /**
     * 删除轮播
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \Exception
     */
    public function remove()
    {
        return $this->delete();
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
