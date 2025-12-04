<?php

use yii\db\Migration;

class m250926_105844_tile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tiles}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'image_url' => $this->string()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
        ]);

        $this->createIndex('idx-tiles-type', '{{%tiles}}', 'type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tiles}}');
    }
}
