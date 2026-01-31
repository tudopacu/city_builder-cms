<?php

use yii\db\Migration;

class m260131_082900_update_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Remove rarity and max_stack columns
        $this->dropColumn('{{%items}}', 'rarity');
        $this->dropColumn('{{%items}}', 'max_stack');

        // Add item_recipe_id column
        $this->addColumn('{{%items}}', 'item_recipe_id', $this->integer()->null());

        // Add foreign key constraint (assuming item_recipes table will be created)
        // Uncomment when item_recipes table exists:
        // $this->addForeignKey(
        //     'fk-items-item_recipe_id',
        //     '{{%items}}',
        //     'item_recipe_id',
        //     '{{%item_recipes}}',
        //     'id',
        //     'SET NULL',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key if it exists
        // Uncomment when foreign key is added:
        // $this->dropForeignKey('fk-items-item_recipe_id', '{{%items}}');

        // Remove item_recipe_id column
        $this->dropColumn('{{%items}}', 'item_recipe_id');

        // Re-add rarity and max_stack columns
        $this->addColumn('{{%items}}', 'rarity', $this->string(20)->notNull()->defaultValue('common'));
        $this->addColumn('{{%items}}', 'max_stack', $this->integer()->notNull()->defaultValue(1));
    }
}
