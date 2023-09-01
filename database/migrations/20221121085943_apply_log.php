<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ApplyLog extends Migrator
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->table('user_apply_log')
            ->addColumn('apply_id', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '申请ID'))
            ->addColumn('user_id', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '用户ID'))
            ->addColumn(Column::decimal('money')->setComment('提现金额')->setDefault(null))
            ->addColumn(Column::tinyInteger('type')->setComment('提现方式：1线下 2支付宝 3微信 4银联')->setDefault(0))
            ->addColumn(Column::tinyInteger('aduit_status')->setComment('审核状态：0未审核 1审核通过 2审核驳回')->setDefault(0))
            ->addColumn(Column::tinyInteger('is_delete')->setComment('是否删除')->setDefault(0))
            ->addColumn('card_no', 'string', array('limit' => 30, 'default' => null, 'comment' => '银行卡号'))
            ->addColumn('wechat_no', 'string', array('limit' => 30, 'default' => null, 'comment' => '微信号'))
            ->addColumn('alipay', 'string', array('limit' => 30, 'default' => null, 'comment' => '支付宝号'))
            ->addColumn('describe', 'string', array('limit' => 500, 'default' => '', 'comment' => '描述/说明'))
            ->addColumn('remark', 'string', array('limit' => 500, 'default' => '', 'comment' => '管理员备注'))
            ->addColumn('store_id', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '小程序商城ID'))
            ->addColumn('create_time', 'integer', array('limit' => 11, 'default' =>0, 'comment' => '创建时间'))
            ->addIndex('apply_id', ['name' => 'apply_id'])
            ->addIndex('user_id',['name'=>'user_id'])
            ->addIndex('store_id',['name'=>'store_id'])
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('user_apply_log');
    }
}
