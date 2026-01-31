<?php

use yii\db\Migration;

class m260131_132300_building_construction_costs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%building_construction_costs}}', [
            'id' => $this->primaryKey(),
            'building_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk-building_construction_costs-building_id',
            '{{%building_construction_costs}}',
            'building_id',
            '{{%buildings}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-building_construction_costs-item_id',
            '{{%building_construction_costs}}',
            'item_id',
            '{{%items}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-building_construction_costs-building_id',
            '{{%building_construction_costs}}',
            'building_id'
        );

        $this->createIndex(
            'idx-building_construction_costs-item_id',
            '{{%building_construction_costs}}',
            'item_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%building_construction_costs}}');
    }
}
