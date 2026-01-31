<?php

use yii\db\Migration;

class m260131_092800_item_recipe_inputs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_recipe_inputs}}', [
            'id' => $this->primaryKey(),
            'recipe_id' => $this->integer()->notNull(),
            'input_item_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk-item_recipe_inputs-recipe_id',
            '{{%item_recipe_inputs}}',
            'recipe_id',
            '{{%item_recipes}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-item_recipe_inputs-input_item_id',
            '{{%item_recipe_inputs}}',
            'input_item_id',
            '{{%items}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-item_recipe_inputs-recipe_id',
            '{{%item_recipe_inputs}}',
            'recipe_id'
        );

        $this->createIndex(
            'idx-item_recipe_inputs-input_item_id',
            '{{%item_recipe_inputs}}',
            'input_item_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_recipe_inputs}}');
    }
}
