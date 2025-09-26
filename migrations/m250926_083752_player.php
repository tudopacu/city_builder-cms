<?php

use yii\db\Migration;

class m250926_083752_player extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%players}}', [
            'id' => $this->primaryKey(), // Auto-increment integer ID
            'username' => $this->string(50)->notNull()->unique(),
            'email' => $this->string(255)->unique(),
            'password' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'last_login_at' => $this->timestamp()->null(),
            'status' => "ENUM('active','banned','suspended') NOT NULL DEFAULT 'active'"
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%players}}');
    }
}
