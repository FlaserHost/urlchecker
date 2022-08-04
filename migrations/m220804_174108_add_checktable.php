<?php
use yii\db\Migration;

class m220804_174108_add_checktable extends Migration
{
    public function up()
    {
        $this->createTable('checktable', [
            'check_id' => $this->primaryKey(),
            'check_date' => $this->date(),
            'url' => $this->string(255)->notNull(),
            'http' => $this->string(255)->notNull(),
            'attempt' => $this->integer()->notNull()
        ]);
    }

    public function down()
    {
        echo "m220804_174108_add_checktable cannot be reverted.\n";

        return false;
    }
}
