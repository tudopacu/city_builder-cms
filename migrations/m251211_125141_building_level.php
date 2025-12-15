<?php

use yii\db\Migration;

class m251211_125141_building_level extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%building_levels}}', [
            'id' => $this->primaryKey(),
            'building_id' => $this->integer()->notNull(),
            'level' => $this->integer()->notNull(),
            'build_time_seconds' => $this->integer()->notNull(),
            'image_url' => $this->string()->null(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk_levels_building',
            '{{%building_levels}}',
            'building_id',
            '{{%buildings}}',
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
        $this->dropTable('{{%building_levels}}');
    }
}
