<?php

use yii\db\Migration;

/**
 * Class m190611_114342_rename_like_assignments_table
 */
class m190611_114342_rename_like_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('{{%blog_like_assignments}}', '{{%blog_post_likes}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('{{%blog_post_likes}}', '{{%blog_like_assignments}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190611_114342_rename_like_assignments_table cannot be reverted.\n";

        return false;
    }
    */
}
