<?php

use think\migration\db\Column;
use think\migration\Migrator;

class ShopUser extends Migrator
{

    /**
     * Migrate Up.
     */
    public function up()
    {
        $table_goods = $this->table('goods');
        $table_goods->addColumn('business_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '门店ID', 'after' => 'store_id'))
            ->addIndex(['business_id'], ['name' => 'business_id'])->save();

        $table = $this->table('user');
        $table->addColumn('refereeId', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '推荐人ID', 'after' => 'store_id'))
            ->addIndex(['refereeId'], ['name' => 'refereeId'])->save();
        //添加门店表
        if (!$this->hasTable('business')) {
            $table = $this->table('business')->setComment('门店表');
            $table->addColumn('title', 'string', array('limit' => 80, 'default' => '', 'comment' => '门店标题'))
                ->addColumn('province_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '省份ID'))
                ->addColumn('city_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '城市ID'))
                ->addColumn('region_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '区/县ID'))
                ->addColumn(Column::decimal('longitude', 20, 10)->setComment('经度')->setDefault(0))
                ->addColumn(Column::decimal('latitude', 20, 10)->setComment('纬度')->setDefault(0))
                ->addColumn(Column::tinyInteger('lon_lat_type')->setComment('经纬度类型 区分各个地图的标识 1 高德地图 2 百度地图 3 腾讯地图')->setDefault(3))
                ->addColumn('store_address', 'string', array('limit' => 255, 'default' => '', 'comment' => '门店详细地址'))
                ->addColumn('merchant_name', 'string', array('limit' => 45, 'default' => '', 'comment' => '商家姓名'))
                ->addColumn('mobile', 'string', array('limit' => 11, 'default' => '', 'comment' => '联系人手机号'))
                ->addColumn(Column::tinyInteger('status')->setComment('门店状态 1：有效 0：无效')->setDefault(0))
                ->addColumn(Column::tinyInteger('is_delete')->setComment('是否删除 1：是 0：否')->setDefault(0))
                ->addColumn('store_user_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '管理员id'))
                ->addColumn('store_user_name', 'string', array('limit' => 50, 'default' => '', 'comment' => '管理员姓名'))
                ->addColumn('create_at', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
                ->addColumn('update_at', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '更新时间'))
                ->create();
        }
        //门店图片
        if (!$this->hasTable('business_image')) {
            $table = $this->table('business_image')->setComment('门店图片表');
            $table->addColumn('business_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '门店ID'))
                ->addColumn(Column::tinyInteger('type')->setComment('图片类型 1:营业执照 2:商家门头照片(多张) 3:商家门店照片')->setDefault(0))
                ->addColumn('image_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '图片id(关联文件记录表)'))
                ->addColumn('store_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '商城ID'))
                ->addColumn('create_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
                ->create();
        }
        //绑定银行卡
        if (!$this->hasTable('user_bank')) {
            $table = $this->table('user_bank')->setComment('绑定银行卡表');
            $table->addColumn('user_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '用户ID'))
                ->addColumn('card_no', 'string', array('limit' => 30, 'default' => '', 'comment' => '银行卡号'))
                ->addColumn('bank_name', 'string', array('limit' => 80, 'default' => '', 'comment' => '所属银行名称'))
                ->addColumn('bank_branch', 'string', array('limit' => 80, 'default' => '', 'comment' => '支行名称'))
                ->addColumn(Column::tinyInteger('is_used')->setComment('是否默认 1：是 0：否')->setDefault(0))
                ->addColumn(Column::tinyInteger('is_delete')->setComment('是否删除 1：是 0：否')->setDefault(0))
                ->addColumn('create_at', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
                ->addColumn('update_at', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '更新时间'))
                ->addIndex('user_id', ['name' => 'user_id'])
                ->create();
        }

    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table_goods = $this->table('goods');
        $table_goods->removeColumn('business_id')->save();

        $table = $this->table('user');
        $table->removeColumn('refereeId')->save();

        $this->dropTable('business');
        $this->dropTable('business_image');
        $this->dropTable('user_bank');
    }
}
