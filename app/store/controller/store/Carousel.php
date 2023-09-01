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

namespace app\store\controller\store;

use app\store\controller\Controller;
use app\store\model\store\Carousel as CarouselModel;
use think\response\Json;

/**
 * 轮播图管理
 * Class Carousel
 * @package app\admin\controller
 */
class Carousel extends Controller
{

    /**
     * 轮播图列表
     * @return array
     * @throws \think\db\exception\DbException
     */
    public function list():Json
    {
        // 轮播图列表
        $model = new CarouselModel;
        $list = $model->getList($this->request->param());
        return $this->renderSuccess(compact('list'));
    }

    /**
     * 添加轮播图
     * @return \think\response\Json
     */
    public function add():Json
    {
        $model=new CarouselModel;
        if(!$model->add($this->postForm())){
            return $this->renderError($model->getError() ?: '添加失败');
        }
        return $this->renderSuccess('添加成功');
    }

    /**
     * 获取详情
     * @param int $carouselId
     * @return Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function detail(int $carouselId):Json
    {
        // 轮播详情
        $detail= CarouselModel::detail($carouselId);
        // 获取image (这里不能用with因为编辑页需要image对象)
        !empty($detail) && $detail['image'];
        return $this->renderSuccess(compact('detail'));
    }

    /**
     * 更新轮播
     * @param $carouselId
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit(int $carouselId):Json
    {
        // 轮播详情
        $model = CarouselModel::detail($carouselId);
        // 更新记录
        if ($model->edit($this->postForm())) {
            return $this->renderSuccess('更新成功');
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }


    /**
     * 删除轮播
     * @param $courseId
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function delete(int $carouselId):Json
    {
        // 轮播详情
        $model = CarouselModel::detail($carouselId);
        if (!$model->remove()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
