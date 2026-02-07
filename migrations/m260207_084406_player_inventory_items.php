<?php

use yii\db\Migration;

class m260207_084406_player_inventory_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%player_inventory_items}}', [
            'id' => $this->primaryKey(),
            'player_inventory_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk_pii_player_inventory',
            '{{%player_inventory_items}}',
            'player_inventory_id',
            '{{%player_inventories}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_pii_item',
            '{{%player_inventory_items}}',
            'item_id',
            '{{%items}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx_pii_player_inventory_item',
            '{{%player_inventory_items}}',
            ['player_inventory_id', 'item_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%player_inventory_items}}');
    }
}
