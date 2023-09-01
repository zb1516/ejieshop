<?php

namespace app\common\validate;

use think\Validate;

/**
 * Class MaterialTypeValidate
 *
 * @package app\prt\validate
 * @see     \think\Validate::unique 解析器
 */
class BaseValidate extends Validate
{
    /**
     * 根据表单数据动态挂载 pkId
     * 编辑时的 unique 校验 应使用 pkId 来忽略当前行
     * 同时如果有软删除 那么还要加入 deleted=0 的条件来限制只校验有效记录
     * formData ['col1' => xxx, 'col2' => xxx, 'deleted'=>0]
     * unique|modelName,col1^col2^deleted,pkId
     * unique多字段校验时验证器会检查表单数据有对应的字段，存在才会加入条件
     * 为了忽略软删除要让表单数据中的 deleted=0 显示定义，排除已删除的数据
     * BaseValidate constructor.
     *
     * @param int   $pkId
     * @param array $rules
     * @param array $message
     * @param array $field
     */
    public function __construct($pkId = 0, array $rules = [], array $message = [], array $field = [])
    {
        parent::__construct($rules, $message, $field);
        // 有 id 则为编辑，追加pkId条件
        // 无 id 则为新增，全局唯一检查
        array_walk($this->rule, function (&$row) use ($pkId) {
            $row = str_replace(",{pkId}", "," . $pkId ?? "", $row);
        }, $this->rule);
    }
}