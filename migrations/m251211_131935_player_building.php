<?php

use yii\db\Migration;

class m251211_131935_player_building extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%player_buildings}}', [
            'id' => $this->primaryKey(),
            'player_id' => $this->integer()->notNull(),
            'building_id' => $this->integer()->notNull(),
            'map_id' => $this->integer()->notNull(),
            'building_level_id' => $this->integer()->notNull(),
            'x' => $this->integer()->notNull(),
            'y' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk_pb_player',
            '{{%player_buildings}}',
            'player_id',
            '{{%players}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_pb_building',
            '{{%player_buildings}}',
            'building_id',
            '{{%buildings}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_pb_building_level',
            '{{%player_buildings}}',
            'building_level_id',
            '{{%building_levels}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_pb_building_map',
            '{{%player_buildings}}',
            'map_id',
            '{{%maps}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx_pb_player_coordinates',
            '{{%player_buildings}}',
            ['player_id', 'x', 'y'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%player_buildings}}');
    }
}
