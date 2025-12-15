<?php

use yii\db\Migration;

class m251211_083235_building_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%building_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%building_categories}}');
    }
}
