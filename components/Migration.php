<?php

namespace app\components;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\components
 */
class Migration extends \yii\db\Migration
{
    /** @var null|string */
    public $tableOptions = null;

    public function init()
    {
        parent::init();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    }
}
