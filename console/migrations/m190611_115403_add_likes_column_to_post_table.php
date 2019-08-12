<?php

use yii\db\Migration;

/**
 * Handles adding likes to table `{{%post}}`.
 */
class m190611_115403_add_likes_column_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_posts}}', 'likes', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%blog_posts}}', 'likes');
    }
}
