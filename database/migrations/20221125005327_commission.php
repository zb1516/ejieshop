<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Commission extends Migrator
{
    public function up()
    {
        $this->table('commission')
            ->addColumn('commission_id', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '佣金比ID'))
            ->addColumn('scale_name', 'string', array('limit' => 30, 'default' => '', 'comment' => '佣金比例项'))
            ->addColumn('scale_value', 'string', array('limit' => 30, 'default' => '', 'comment' => '佣金比例值'))
            ->addColumn(Column::tinyInteger('is_delete')->setComment('是否删除')->setDefault(0))
            ->addColumn('store_id', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '小程序商城ID'))
            ->addColumn('create_time', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '创建时间'))
            ->addColumn('update_time', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '更新时间'))
            ->addIndex('commission_id', ['name' => 'commission_id'])
            ->addIndex('scale_name',['name'=>'scale_name'])
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('commission');
    }
}
