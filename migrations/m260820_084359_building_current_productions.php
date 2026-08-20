<?php

use yii\db\Migration;

class m260820_084359_building_current_productions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%building_current_productions}}', [
            'player_id' => $this->integer()->notNull(),
            'player_building_id' => $this->integer()->notNull(),
            'building_production_id' => $this->integer()->notNull(),
            'end_time' => $this->dateTime()->notNull(),
            'status' => "ENUM('PENDING','DONE','COLLECTED') NOT NULL DEFAULT 'PENDING'",
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addPrimaryKey(
            'pk_bcp',
            '{{%building_current_productions}}',
            ['player_id', 'player_building_id', 'building_production_id']
        );

        $this->addForeignKey(
            'fk_bcp_player',
            '{{%building_current_productions}}',
            'player_id',
            '{{%players}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_bcp_player_building',
            '{{%building_current_productions}}',
            'player_building_id',
            '{{%player_buildings}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_bcp_building_production',
            '{{%building_current_productions}}',
            'building_production_id',
            '{{%building_productions}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx_bcp_player',
            '{{%building_current_productions}}',
            'player_id'
        );

        $this->createIndex(
            'idx_bcp_player_building',
            '{{%building_current_productions}}',
            'player_building_id'
        );

        $this->createIndex(
            'idx_bcp_building_production',
            '{{%building_current_productions}}',
            'building_production_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_bcp_player', '{{%building_current_productions}}');
        $this->dropForeignKey('fk_bcp_player_building', '{{%building_current_productions}}');
        $this->dropForeignKey('fk_bcp_building_production', '{{%building_current_productions}}');
        $this->dropPrimaryKey('pk_bcp', '{{%building_current_productions}}');
        $this->dropTable('{{%building_current_productions}}');
    }
}
