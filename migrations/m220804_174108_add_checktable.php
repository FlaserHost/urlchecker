<?php
use yii\db\Migration;

class m220804_174108_add_checktable extends Migration
{
    public function up()
    {
        $this->createTable('{{%checktable}}', [
            'check_id' => $this->primaryKey(),
            'check_date' => $this->date()->notNull(),
            'user_id' => $this->string(33),
            'url' => $this->string(255)->notNull(),
            'url_id' => $this->integer()->notNull(),
            'http' => $this->integer()->notNull(),
            'attempt' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'FK_url_id',
            '{{%checktable}}',
            'url_id'
        );

        $this->addForeignKey(
            'FK_url_id',
            '{{%checktable}}',
            'url_id',
            '{{%urltable}}',
            'url_id',
            'NO ACTION',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%checktable}}');
    }
}
