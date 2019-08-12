<?php

use yii\db\Migration;

class m190530_155100_add_blog_tag_assignments_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%blog_tag_assignments}}', [
            'post_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk-blog_tag_assignments}}', '{{%blog_tag_assignments}}', ['post_id', 'tag_id']);

        $this->createIndex('{{%idx-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}', 'post_id');
        $this->createIndex('{{%idx-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}', 'tag_id');

        $this->addForeignKey('{{%fk-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}', 'post_id', '{{%blog_posts}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}', 'tag_id', '{{%blog_tags}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropPrimaryKey('{{%pk-blog_tag_assignments}}', '{{%blog_tag_assignments}}');
        $this->dropForeignKey('{{%fk-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}');
        $this->dropForeignKey('{{%fk-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}');

        $this->dropTable('{{%blog_tag_assignments}}');
    }
}