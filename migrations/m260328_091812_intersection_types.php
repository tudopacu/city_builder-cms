<?php

use yii\db\Migration;

class m260328_091812_intersection_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%intersections}}', 'type', $this->string()->after('y'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%intersections}}', 'type');
    }
}
