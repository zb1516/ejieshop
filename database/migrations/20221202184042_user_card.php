<?php

use think\migration\db\Column;
use think\migration\Migrator;

class UserCard extends Migrator
{

    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('recharge_order');
        $table->addColumn('card_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '会员卡ID', 'after' => 'plan_id'))->save();
        $table->changeColumn(Column::tinyInteger('recharge_type')->setComment('充值方式(10自定义金额 20套餐充值 30会员卡充值)')->setDefault(10))->save();
       
        $table = $this->table('recharge_order_plan');
        $table->addColumn('card_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '会员卡ID', 'after' => 'plan_id'))->save();

        $table = $this->table('order');
        $table->addColumn('refereeId', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '推荐人ID', 'after' => 'store_id'))
              ->addColumn(Column::decimal('refree_price', 10, 2)->setComment('返佣金额')->setDefault(0))
              ->addIndex(['refereeId'], ['name' => 'refereeId'])
              ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table = $this->table('recharge_order');
        $table->removeColumn('card_id')->save();

        $table = $this->table('recharge_order_plan');
        $table->removeColumn('card_id')->save();

        $table = $this->table('order');
        $table->removeColumn('refereeId')->removeColumn('refree_price')->save();
    }
}
