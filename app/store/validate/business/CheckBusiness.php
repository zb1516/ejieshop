<?php
namespace app\store\validate\business;
use think\Validate;

class CheckBusiness extends Validate
{

    protected $rule = [
        'title' => ['require', 'max' => '80'],
        'store_address' => ['require', 'max' => '255'],
        'longitude' => ['require', 'max' => '30'],
        'latitude' => ['require', 'max' => '30'],
        'merchant_name' => ['require', 'max' => '45'],
        'business_license' => ['require'],
        'province_id' => ['require', 'number', 'max' => '11'],
        'city_id' => ['require', 'number', 'max' => '11'],
        'region_id' => ['require', 'number', 'max' => '11'],
        'store_user_id' => ['require', 'number', 'max' => '11'],
        'mobile' => ['require', 'number', 'max' => '11', 'min' => '11', 'mobile'],
    ];

    protected $message = [
        'title.require' => '门店标题不能为空',

        'longitude.require' => '经度不能为空',
        'latitude.require' => '纬度不能为空',
        
        'longitude.max' => '城市ID不能超过30位',
        'latitude.max' => '区ID不能超过30位',

        'province_id.require' => '省份ID不能为空',
        'city_id.require' => '城市ID不能为空',
        'region_id.require' => '区ID不能为空',
        'province_id.number' => '省份ID是全数字',
        'city_id.number' => '城市ID是全数字',
        'region_id.number' => '区ID是全数字',
        'province_id.max' => '省份ID不能超过11位',
        'city_id.max' => '城市ID不能超过11位',
        'region_id.max' => '区ID不能超过11位',

        'store_address.require' => '门店详细地址不能为空',
        'store_address.max' => '门店详细地址不能超过255位',

        
        'store_user_id.require' => '管理员ID不能为空',
        'store_user_id.number' => '管理员ID是全数字',
        'store_user_id.max' => '管理员ID不能超过11位',

        'merchant_name.require' => '商家姓名不能为空',
        'merchant_name.max' => '商家姓名不能超过45位',

        'mobile.require' => '联系人手机号不能为空',
        'mobile.number' => '联系人手机号是全数字',
        'mobile.mobile' => '联系人手机号格式错误',

        'business_license.require' => '门店营业执照不能为空',
    ];
}
