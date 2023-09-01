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

namespace app\common\library;

/**
 * 地图
 * Class Lock
 * @package app\common\library
 */
class Map
{
    /**
     * 根据经纬度获取城市code
     * @param string $latitude
     * @param string $longitude
     * @return mixed
     */
    public static function getCityLocation(string $latitude , string $longitude)
    {
      $url=config("map.map_url").'/'.config("map.geocoder")."/?location=".$latitude.",".$longitude."&key=".config("map.key")."&output=".config("map.output");
      $output=file_get_contents($url);
      $result=json_decode($output,true);
      if ($result['status'] == 0){
          return $result['result']['location'];
      }
      return [];
    }
}
