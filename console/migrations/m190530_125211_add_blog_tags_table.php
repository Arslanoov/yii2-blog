<?php

use yii\db\Migration;

class m190530_125211_add_blog_tags_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%blog_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%blog_tags}}');
    }
}