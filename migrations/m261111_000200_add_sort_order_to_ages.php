<?php

use yii\db\Migration;

class m261111_000200_add_sort_order_to_ages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // MySQL commits DDL implicitly: guard each step so a failed run can be re-run
        if ($this->db->getTableSchema('ages', true)->getColumn('sort_order') === null) {
            $this->addColumn('{{%ages}}', 'sort_order', $this->integer()->notNull()->defaultValue(0)->after('description'));
        }

        // Steps of 10 leave room to slot new ages between existing ones
        $this->update('{{%ages}}', ['sort_order' => new \yii\db\Expression('id * 10')], ['sort_order' => 0]);

        $existing = array_column($this->db->createCommand('SHOW INDEX FROM {{%ages}}')->queryAll(), 'Key_name');
        if (!in_array('idx_ages_sort_order', $existing, true)) {
            $this->createIndex('idx_ages_sort_order', '{{%ages}}', 'sort_order');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        if ($this->db->getTableSchema('ages', true)->getColumn('sort_order') !== null) {
            $this->dropColumn('{{%ages}}', 'sort_order');
        }
    }
}
