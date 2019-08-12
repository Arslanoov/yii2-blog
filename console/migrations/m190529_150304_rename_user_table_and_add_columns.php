<?php

use yii\db\Migration;

/**
 * Class m190529_150304_rename_user_table
 */
class m190529_150304_rename_user_table_and_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('{{%user}}', '{{%users}}');
        $this->addColumn('{{%users}}', 'photo', $this->string());
        $this->addColumn('{{%users}}', 'about_me', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'about_me');
        $this->dropColumn('{{%users}}', 'photo');
        $this->renameTable('{{%users}}', '{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190529_150304_rename_user_table cannot be reverted.\n";

        return false;
    }
    */
}
