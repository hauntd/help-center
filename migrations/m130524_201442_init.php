<?php

use app\components\Migration;

class m130524_201442_init extends Migration
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
            'alias' => $this->string(32)->notNull()->unique(),
            'isVisible' => $this->boolean()->defaultValue(1),
        ], $this->tableOptions);

        $this->createTable('{{%categoryLang}}', [
            'id' => $this->primaryKey(),
            'categoryId' => $this->integer(),
            'title' => $this->string(255)->notNull(),
            'isVisible' => $this->boolean()->defaultValue(1),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ], $this->tableOptions);
        $this->addForeignKey('categoryLangFk', 'categoryLang', 'categoryId', 'category', 'id', 'cascade');

        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'categoryId' => $this->integer()->notNull(),
            'isVisible' => $this->boolean()->defaultValue(1),
        ], $this->tableOptions);

        $this->createTable('{{%postLang}}', [
            'id' => $this->primaryKey(),
            'postId' => $this->integer()->notNull(),
            'alias' => $this->string(255)->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'isVisible' => $this->boolean()->defaultValue(1),
            'order' => $this->integer()->defaultValue(0),
            'createdAt' => $this->dateTime(),
            'updatedA' => $this->dateTime(),
        ], $this->tableOptions);
        $this->addForeignKey('postLangFk', 'postLang', 'postId', 'post', 'id', 'cascade');

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
        $this->dropForeignKey('categoryLangFk', 'categoryLang');
        $this->dropForeignKey('postLangFk', 'postLang');
        $this->dropTable('{{%postLang}}');
        $this->dropTable('{{%postTag}}');
        $this->dropTable('{{%tag}}');
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%categoryLang}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%user}}');

        return true;
    }
}
