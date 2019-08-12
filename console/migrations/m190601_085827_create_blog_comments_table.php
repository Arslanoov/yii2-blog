<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_comments}}`.
 */
class m190601_085827_create_blog_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_comments}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'active' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-blog_comments-post_id', '{{%blog_comments}}', 'post_id');
        $this->createIndex('idx-blog_comments-user_id', '{{%blog_comments}}', 'user_id');
        $this->createIndex('idx-blog_comments-parent_id', '{{%blog_comments}}', 'parent_id');

        $this->addForeignKey('{{%fk-blog_comments-post_id}}', '{{%blog_comments}}', 'post_id', '{{%blog_posts}}', 'id', 'CASCADE');
        $this->addForeignKey('{{%fk-blog_comments-user_id}}', '{{%blog_comments}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
        $this->addForeignKey('{{%fk-blog_comments-parent_id}}', '{{%blog_comments}}', 'parent_id', '{{%blog_comments}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-blog_comments-post_id}}', '{{%blog_comments}}');
        $this->dropForeignKey('{{%fk-blog_comments-user_id}}', '{{%blog_comments}}');
        $this->dropForeignKey('{{%fk-blog_comments-parent_id}}', '{{%blog_comments}}');

        $this->dropTable('{{%blog_comments}}');
    }
}
