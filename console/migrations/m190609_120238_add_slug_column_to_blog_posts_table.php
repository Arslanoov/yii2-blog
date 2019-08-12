<?php

use yii\db\Migration;

/**
 * Handles adding slug to table `{{%blog_posts}}`.
 */
class m190609_120238_add_slug_column_to_blog_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_posts}}', 'slug', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
