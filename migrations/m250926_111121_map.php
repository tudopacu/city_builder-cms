<?php

use yii\db\Migration;

class m250926_111121_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%maps}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'width' => $this->integer()->notNull(),
            'length' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
        ]);

        $this->createIndex('idx-maps-name', '{{%maps}}', 'name', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%maps}}');
    }
}
