<?php

use yii\db\Migration;

class m260131_132500_building_productions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%building_productions}}', [
            'id' => $this->primaryKey(),
            'building_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'production_time_seconds' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk-building_productions-building_id',
            '{{%building_productions}}',
            'building_id',
            '{{%buildings}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-building_productions-item_id',
            '{{%building_productions}}',
            'item_id',
            '{{%items}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-building_productions-building_id',
            '{{%building_productions}}',
            'building_id'
        );

        $this->createIndex(
            'idx-building_productions-item_id',
            '{{%building_productions}}',
            'item_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%building_productions}}');
    }
}
