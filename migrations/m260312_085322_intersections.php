<?php

use yii\db\Migration;

class m260312_085322_intersections extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%intersections}}', [
            'id' => $this->primaryKey(),
            'map_id' => $this->integer(),
            'player_id' => $this->integer(),
            'x' => $this->integer()->notNull(),
            'y' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk_intersection_map',
            '{{%intersections}}',
            'map_id',
            '{{%maps}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_intersection_player',
            '{{%intersections}}',
            'player_id',
            '{{%players}}',
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
        $this->dropForeignKey('fk_intersection_player', '{{%intersections}}');
        $this->dropForeignKey('fk_intersection_map', '{{%intersections}}');
        $this->dropTable('{{%intersections}}');
    }
}
