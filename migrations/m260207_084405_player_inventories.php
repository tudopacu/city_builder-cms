<?php

use yii\db\Migration;

class m260207_084405_player_inventories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%player_inventories}}', [
            'id' => $this->primaryKey(),
            'player_id' => $this->integer()->notNull(),
            'player_building_id' => $this->integer()->notNull(),
            'capacity' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk_pi_player',
            '{{%player_inventories}}',
            'player_id',
            '{{%players}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_pi_player_building',
            '{{%player_inventories}}',
            'player_building_id',
            '{{%player_buildings}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%player_inventories}}');
    }
}
