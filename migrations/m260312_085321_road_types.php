<?php

use yii\db\Migration;

class m260312_085321_road_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%road_types}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'image_url' => $this->string(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%road_types}}');
    }
}
