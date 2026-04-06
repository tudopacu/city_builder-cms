<?php

use yii\db\Migration;

class m260406_063515_building_workers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%building_workers}}', [
            'id' => $this->primaryKey(),
            'building_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'range' => $this->integer()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk-building_workers-building_id',
            '{{%building_workers}}',
            'building_id',
            '{{%buildings}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-building_workers-item_id',
            '{{%building_workers}}',
            'item_id',
            '{{%items}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-building_workers-building_id',
            '{{%building_workers}}',
            'building_id'
        );

        $this->createIndex(
            'idx-building_workers-item_id',
            '{{%building_workers}}',
            'item_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%building_workers}}');
    }
}
