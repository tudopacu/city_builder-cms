<?php

use yii\db\Migration;

class m251211_124723_building extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%buildings}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'width' => $this->integer()->notNull(),
            'length' => $this->integer()->notNull(),
            'building_category_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk-buildings-building_category_id',
            '{{%buildings}}',
            'building_category_id',
            '{{%building_categories}}',
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
        $this->dropTable('{{%buildings}}');
    }
}
