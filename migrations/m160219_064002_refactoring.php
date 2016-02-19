<?php

use app\components\Migration;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 */
class m160219_064002_refactoring extends Migration
{
    public function safeUp()
    {
        $this->dropTable('{{%postLang}}');
        $this->dropTable('{{%categoryLang}}');

        $this->addColumn('{{%category}}', 'title', $this->string(255)->notNull());
        $this->addColumn('{{%category}}', 'createdAt', $this->integer()->notNull());
        $this->addColumn('{{%category}}', 'updatedAt', $this->integer()->notNull());

        $this->addColumn('{{%post}}', 'alias', $this->string(255)->notNull()->unique());
        $this->addColumn('{{%post}}', 'title', $this->string(255)->notNull());
        $this->addColumn('{{%post}}', 'content', $this->text()->notNull());
        $this->addColumn('{{%post}}', 'order', $this->integer()->defaultValue(0));
        $this->addColumn('{{%post}}', 'createdAt', $this->integer()->notNull());
        $this->addColumn('{{%post}}', 'updatedAt', $this->integer()->notNull());
    }

    public function safeDown()
    {
        return false;
    }
}
