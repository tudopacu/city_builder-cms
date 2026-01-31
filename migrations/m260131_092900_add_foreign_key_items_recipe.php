<?php

use yii\db\Migration;

class m260131_092900_add_foreign_key_items_recipe extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add foreign key constraint for item_recipe_id in items table
        $this->addForeignKey(
            'fk-items-item_recipe_id',
            '{{%items}}',
            'item_recipe_id',
            '{{%item_recipes}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->createIndex(
            'idx-items-item_recipe_id',
            '{{%items}}',
            'item_recipe_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-items-item_recipe_id', '{{%items}}');
        $this->dropIndex('idx-items-item_recipe_id', '{{%items}}');
    }
}
