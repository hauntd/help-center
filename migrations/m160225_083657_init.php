<?php

use app\components\Migration;

class m160225_083657_init extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'authKey' => $this->string(32)->notNull(),
            'passwordHash' => $this->string()->notNull(),
            'passwordResetToken' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'role' => $this->smallInteger()->notNull()->defaultValue(0),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $this->tableOptions);

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parentId' => $this->integer(),
            'sort' => $this->integer()->defaultValue(0),
            'isVisible' => $this->boolean()->defaultValue(1),
            'alias' => $this->string(32)->notNull()->unique(),
            'title' => $this->string(255)->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $this->tableOptions);
        $this->createIndex('categoryParentSort', '{{%category}}', ['parentId', 'sort']);

        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'categoryId' => $this->integer()->notNull(),
            'sort' => $this->integer()->defaultValue(0),
            'isVisible' => $this->boolean()->defaultValue(1),
            'alias' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $this->tableOptions);

        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'tag' => $this->string(255)->notNull()->unique(),
            'frequency' => $this->integer()->defaultValue(0),
        ], $this->tableOptions);

        $this->createTable('{{%postTag}}', [
            'id' => $this->primaryKey(),
            'postId' => $this->integer()->notNull(),
            'tagId' => $this->integer()->notNull()
        ], $this->tableOptions);
        $this->createIndex('postTagIdx', 'postTag', ['postId', 'tagId'], true);

        return true;
    }

    public function safeDown()
    {
        $this->dropTable('{{%postTag}}');
        $this->dropTable('{{%tag}}');
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%user}}');

        return true;
    }
}
