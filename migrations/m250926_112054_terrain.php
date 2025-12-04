<?php

use yii\db\Migration;

class m250926_112054_terrain extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%terrains}}', [
            'id' => $this->primaryKey(),
            'map_id' => $this->integer()->notNull(),
            'tile_id' => $this->integer()->notNull(),
            'x' => $this->integer()->notNull(),
            'y' => $this->integer()->notNull(),
            'walkable' => $this->boolean()->notNull()->defaultValue(true),
            'set_x' => $this->integer()->notNull(),
            'set_y' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
        ]);

        // Optional: add indexes for faster queries
        $this->createIndex('idx-terrains-map_id', '{{%terrains}}', 'map_id');
        $this->createIndex('idx-terrains-tile_id', '{{%terrains}}', 'tile_id');
        $this->createIndex('idx-terrains-coordinates', '{{%terrains}}', ['map_id', 'x', 'y'], true); // unique per map

        $this->addForeignKey(
            'fk-terrains-map_id',
            'terrains',
            'map_id',
            'maps',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-terrains-tile_id',
            'terrains',
            'tile_id',
            'tiles',
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
        $this->dropForeignKey('fk-terrains-map_id', 'terrains');
        $this->dropForeignKey('fk-terrains-tile_id', 'terrains');

        $this->dropTable('{{%terrains}}');
    }
}
