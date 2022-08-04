<?php
use yii\db\Migration;

class m220804_170541_add_urltable extends Migration
{
    public function up()
    {
        $this->createTable('{{%urltable}}', [
            'url_id' => $this->primaryKey(),
            'creation_date' => $this->date(),
            'url' => $this->string(255)->notNull(),
            'frequency' => $this->integer()->notNull(),
            'repeat_count' => $this->integer()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%urltable}}');
    }
}
