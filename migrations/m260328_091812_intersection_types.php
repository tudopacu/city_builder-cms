<?php

use yii\db\Migration;

class m260328_091812_intersection_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%intersection_types}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'image_url' => $this->string(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $types = [
            'road-tl-br',
            'road-bl-tr',
            'bend-bl-br',
            'bend-br-tr',
            'bend-tr-tl',
            'bend-tr-br',
            't-tr',
            't-br',
            't-bl',
            't-tl',
            'cross',
            'end-tr',
            'end-br',
            'end-bl',
            'end-tl',
        ];

        foreach ($types as $type) {
            $this->insert('{{%intersection_types}}', ['type' => $type]);
        }

        $this->addColumn('{{%intersections}}', 'intersection_type_id', $this->integer()->after('y'));

        $this->addForeignKey(
            'fk_intersection_type',
            '{{%intersections}}',
            'intersection_type_id',
            '{{%intersection_types}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_intersection_type', '{{%intersections}}');
        $this->dropColumn('{{%intersections}}', 'intersection_type_id');
        $this->dropTable('{{%intersection_types}}');
    }
}
