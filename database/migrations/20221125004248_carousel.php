<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Carousel extends Migrator
{
    public function up()
    {
        $this->table('carousel')
            ->addColumn('carousel_id', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '幻灯片ID'))
            ->addColumn('carousel_title', 'string', array('limit' => 30, 'default' => '', 'comment' => '幻灯片标题'))
            ->addColumn('carousel_url', 'string', array('limit' => 150, 'default' => '', 'comment' => '链接地址'))
            ->addColumn('image_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '图片ID'))
            ->addColumn(Column::tinyInteger('carousel_site')->setComment('位置：0上 1中 2下')->setDefault(0))
            ->addColumn('sort', 'integer', array('limit' => 11, 'default' => '0', 'comment' => '排序方式(数字越小越靠前)'))
            ->addColumn(Column::tinyInteger('is_delete')->setComment('是否删除')->setDefault(0))
            ->addColumn('store_id', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '小程序商城ID'))
            ->addColumn('create_time', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '创建时间'))
            ->addColumn('update_time', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '更新时间'))
            ->addIndex('carousel_id', ['name' => 'carousel_id'])
            ->addIndex('image_id',['name'=>'image_id'])
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('carousel');
    }
}
