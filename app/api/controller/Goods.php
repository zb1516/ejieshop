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

namespace app\api\controller;

use think\response\Json;
use app\api\model\{Goods as GoodsModel};
use app\api\service\{Goods as GoodsService, User};

/**
 * 商品控制器
 * Class Goods
 * @package app\api\controller
 */
class Goods extends Controller
{
    /**
     * 商品列表
     * @return \think\response\Json
     * @throws \think\db\exception\DbException
     */
    public function list(): \think\response\Json
    {
        // 获取列表数据
        $model = new GoodsModel;
        $list = $model->getList($this->request->param());
        foreach($list as &$goods){
            $goods['discount_price'] = bcmul((string) $goods['goods_price_min'], User::getMinDiscount(), 2);
        }
        return $this->renderSuccess(compact('list'));
    }

    /**
     * 获取商品详情
     * @param int $goodsId
     * @return \think\response\Json
     * @throws \cores\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function detail(int $goodsId): \think\response\Json
    {
        // 商品详情
        $model = new GoodsModel;
        $goodsInfo = $model->getDetails($goodsId);
        return $this->renderSuccess(['detail' => $goodsInfo]);
    }

    /**
     * 获取商品详情(基础信息)
     * @param int $goodsId
     * @param bool $verifyStatus
     * @return \think\response\Json
     * @throws \cores\exception\BaseException
     */
    public function basic(int $goodsId, bool $verifyStatus = true): \think\response\Json
    {
        // 获取商品详情
        $model = new GoodsModel;
        $detail = $model->getBasic($goodsId, $verifyStatus);
        return $this->renderSuccess(compact('detail'));
    }

    /**
     * 获取商品规格数据
     * @param int $goodsId 商品ID
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function specData(int $goodsId): \think\response\Json
    {
        // 获取商品详情
        $model = new GoodsModel;
        $specData = $model->getSpecData($goodsId);
        return $this->renderSuccess(compact('specData'));
    }

    /**
     * 获取商品的指定SKU信息
     * @param int $goodsId 商品ID
     * @param string $goodsSkuId 商品SKU标识
     * @return Json
     */
    public function skuInfo(int $goodsId, string $goodsSkuId): Json
    {
        $skuInfo = GoodsService::getSkuInfo($goodsId, $goodsSkuId);
        return $this->renderSuccess(compact('skuInfo'));
    }

    /**
     * 通过店铺id查询商品列表
     * @return \think\response\Json
     * @throws \think\db\exception\DbException
     */
    public function storeGoodsList():Json
    {
        // 获取列表数据
        $model = new GoodsModel;
        $params=$this->request->param();
        $list = $model->getListByBusinessId((int)$params['businessId']);
        return $this->renderSuccess(compact('list'));
    }
}
