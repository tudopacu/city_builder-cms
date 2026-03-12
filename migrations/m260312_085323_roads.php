<?php

use yii\db\Migration;

class m260312_085323_roads extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%roads}}', [
            'id' => $this->primaryKey(),
            'start_intersection_id' => $this->integer(),
            'end_intersection_id' => $this->integer(),
            'road_type_id' => $this->integer(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk_road_start_intersection',
            '{{%roads}}',
            'start_intersection_id',
            '{{%intersections}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_road_end_intersection',
            '{{%roads}}',
            'end_intersection_id',
            '{{%intersections}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_road_road_type',
            '{{%roads}}',
            'road_type_id',
            '{{%road_types}}',
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
        $this->dropForeignKey('fk_road_road_type', '{{%roads}}');
        $this->dropForeignKey('fk_road_end_intersection', '{{%roads}}');
        $this->dropForeignKey('fk_road_start_intersection', '{{%roads}}');
        $this->dropTable('{{%roads}}');
    }
}
