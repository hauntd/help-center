<?php

use app\components\Migration;

class m160324_235055_updates extends Migration
{

    public function safeUp()
    {
        $this->addColumn('{{%post}}', 'contentCompiled', $this->text()->notNull());
        $this->addColumn('{{%post}}', 'contentPreview', $this->text()->notNull());

        return true;
    }

    public function safeDown()
    {
        $this->dropColumn('{{%post}}', 'contentCompiled');
        $this->dropColumn('{{%post}}', 'contentPreview');

        return true;
    }
}
