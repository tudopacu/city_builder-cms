<?php

use yii\db\Migration;

class m260123_201400_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%items}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'type' => $this->string(50)->notNull(),
            'icon_url' => $this->string(),
            'is_tradeable' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx_items_type',
            '{{%items}}',
            'type'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%items}}');
    }
}
