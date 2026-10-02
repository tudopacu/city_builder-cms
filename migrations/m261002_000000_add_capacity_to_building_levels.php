<?php

use yii\db\Migration;

class m261002_000000_add_capacity_to_building_levels extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            '{{%building_levels}}',
            'capacity',
            $this->integer()->notNull()->defaultValue(0)->after('image_url')
        );
    }

    public function safeDown()
    {
        $this->dropColumn('{{%building_levels}}', 'capacity');
    }
}
