<?php

use yii\db\Migration;

/**
 * Class m190611_113505_like_assignments_table
 */
class m190611_113505_like_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_like_assignments}}', [
            'user_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk-blog_like_assignments}}', '{{%blog_like_assignments}}', ['user_id', 'post_id']);

        $this->createIndex('{{%idx-blog_like_assignments-user_id}}', '{{%blog_like_assignments}}', 'user_id');
        $this->createIndex('{{%idx-blog_like_assignments-post_id}}', '{{%blog_like_assignments}}', 'post_id');

        $this->addForeignKey('{{%fk-blog_like_assignments-user_id}}', '{{%blog_like_assignments}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-blog_like_assignments-post_id}}', '{{%blog_like_assignments}}', 'post_id', '{{%blog_posts}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-blog_like_assignments-user_id}}', '{{%blog_like_assignments}}');
        $this->dropForeignKey('{{%fk-blog_like_assignments-post_id}}', '{{%blog_like_assignments}}');

        $this->dropTable('{{%blog_like_assignments}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190611_113505_like_assignments_table cannot be reverted.\n";

        return false;
    }
    */
}
