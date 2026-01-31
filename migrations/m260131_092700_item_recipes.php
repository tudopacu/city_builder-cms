<?php

use yii\db\Migration;

class m260131_092700_item_recipes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_recipes}}', [
            'id' => $this->primaryKey(),
            'output_item_id' => $this->integer()->notNull(),
            'production_time_seconds' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk-item_recipes-output_item_id',
            '{{%item_recipes}}',
            'output_item_id',
            '{{%items}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-item_recipes-output_item_id',
            '{{%item_recipes}}',
            'output_item_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_recipes}}');
    }
}
