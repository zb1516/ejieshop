<?php

use think\migration\db\Column;
use think\migration\Migrator;

class UserMembershipCard extends Migrator
{

    /**
     * Migrate Up.
     */
    public function up()
    { 
        //会员卡权益配置表
        if (!$this->hasTable('membership_card_config')) {
            $table = $this->table('membership_card_config')->setComment('会员卡权益配置表');
            $table->addColumn('name', 'string', array('limit' => 30, 'default' => '', 'comment' => '会员卡名称'))
                ->addColumn(Column::decimal('amount', 20, 2)->setComment('充值金额')->setDefault(0))
                ->addColumn('validity_month', 'integer', array('limit' => 10, 'default' => 0, 'comment' => '有效期(单位：月)'))
                ->addColumn(Column::decimal('discount', 20, 2)->setComment('享有商品折扣 例:8折 0.8')->setDefault(0))
                ->addColumn('image_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '图片file_id'))
                ->addColumn(Column::decimal('commission', 20, 2)->setComment('邀请人分润比例 例:5% 0.05')->setDefault(0))
                ->addColumn('equity_goods_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '指定权益商品ID'))
                ->addColumn('gift_goods_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '指定赠品商品ID'))
                ->addColumn('equity_remark', 'string', array('limit' => 255, 'default' => '', 'comment' => '权益说明'))
                ->addColumn('gift_remark', 'string', array('limit' => 255, 'default' => '', 'comment' => '赠品说明'))
                ->addColumn(Column::tinyInteger('is_delete')->setComment('是否删除 1：是 0：否')->setDefault(0))
                ->addColumn(Column::tinyInteger('is_recharge')->setComment('是否充值到余额 1：是 0：否')->setDefault(0))
                ->addColumn('sort', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '排序越大越靠前'))
                ->addColumn('create_at', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
                ->addColumn('update_at', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '更新时间'))
                ->create();
        }
        //用户会员卡表
        if (!$this->hasTable('user_membership_card')) {
            $table = $this->table('user_membership_card')->setComment('用户会员卡表');
            $table->addColumn('membership_card_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '会员卡权益配置表ID'))
                ->addColumn('user_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '用户ID')) 
                ->addColumn('name', 'string', array('limit' => 30, 'default' => '', 'comment' => '会员卡名称'))
                ->addColumn('validity_month', 'integer', array('limit' => 10, 'default' => 0, 'comment' => '有效期(单位：月)'))
                ->addColumn(Column::decimal('discount', 20, 2)->setComment('享有商品折扣 例:8折 0.8')->setDefault(0)) 
                ->addColumn('equity_goods_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '指定权益商品ID'))
                ->addColumn('gift_goods_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '指定赠品商品ID'))
                ->addColumn('equity_remark', 'string', array('limit' => 50, 'default' => '', 'comment' => '权益说明'))
                ->addColumn('gift_remark', 'string', array('limit' => 50, 'default' => '', 'comment' => '赠品说明'))
                ->addColumn('create_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
                ->addColumn('deadline_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '截止日时间'))
                ->addIndex(['user_id'], ['name' => 'user_id'])
                ->addIndex(['membership_card_id'], ['name' => 'membership_card_id'])
                ->create();
        }
         //会员权益领取记录表
         if (!$this->hasTable('user_membership_card_log')) {
            $table = $this->table('user_membership_card_log')->setComment('会员权益领取记录表');
            $table->addColumn('user_membership_card_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '用户会员卡ID')) 
                ->addColumn('membership_card_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '会员卡权益配置表ID'))
                ->addColumn('user_id', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '用户ID'))
                ->addColumn(Column::tinyInteger('type')->setComment('类型 1:权益 2:赠品')->setDefault(0))
                ->addColumn(Column::tinyInteger('status')->setComment('领取状态 1:已领取 0:未领取')->setDefault(0))
                ->addColumn('receive_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '领取日时间'))
                ->addColumn('create_time', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '创建时间'))
                ->addColumn('update_at', 'integer', array('limit' => 11, 'default' => 0, 'comment' => '更新时间'))
                ->addIndex(['user_id','membership_card_id'], ['name' => 'membership'])
                ->create();
        }
       
        $table = $this->table('goods');
        $table->addColumn(Column::tinyInteger('type')->setComment('类型 1:普通商品 2:0元购商品')->setDefault(1))->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        if ($this->hasTable('user_membership_card_log')) {
            $this->dropTable('user_membership_card_log');
        }
        if ($this->hasTable('user_membership_card')) {
            $this->dropTable('user_membership_card');
        }
        if ($this->hasTable('membership_card_config')) {
            $this->dropTable('membership_card_config');
        }
        $table = $this->table('goods');
        $table->removeColumn('type')->save();
    }
}
