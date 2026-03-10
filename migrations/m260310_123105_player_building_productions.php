<?php

use yii\db\Migration;

class m260310_123105_player_building_productions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%player_building_productions}}', [
            'id' => $this->primaryKey(),
            'player_building_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'end_time' => $this->dateTime()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk_pbp_player_building',
            '{{%player_building_productions}}',
            'player_building_id',
            '{{%player_buildings}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_pbp_item',
            '{{%player_building_productions}}',
            'item_id',
            '{{%items}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx_pbp_player_building',
            '{{%player_building_productions}}',
            'player_building_id',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%player_building_productions}}');
    }
}
