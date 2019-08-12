<?php

use yii\db\Migration;

/**
 * Class m190601_083448_add_user_roles
 */
class m190601_083448_add_user_roles extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%auth_items}}', ['type', 'name', 'description'], [
            [1, 'user', 'User'],
            [1, 'manager', 'Manager'],
            [1, 'moderator', 'Moderator'],
            [1, 'content-manager', 'Content Manager'],
            [1, 'admin', 'Admin'],
        ]);

        $this->batchInsert('{{%auth_item_children}}', ['parent', 'child'], [
            ['manager', 'user'],
            ['moderator', 'user'],
            ['content-manager', 'moderator'],
            ['admin', 'content-manager'],
            ['admin', 'manager']
        ]);

        $this->execute('INSERT INTO {{%auth_assignments}} (item_name, user_id) SELECT \'user\', u.id FROM {{%users}} u ORDER BY u.id');
    }

    public function down()
    {
        $this->delete('{{%auth_items}}', ['name' => ['user', 'manager', 'moderator', 'content-manager', 'admin']]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190601_083448_add_user_roles cannot be reverted.\n";

        return false;
    }
    */
}
