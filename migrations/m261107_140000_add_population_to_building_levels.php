<?php

use yii\db\Migration;

class m261107_140000_add_population_to_building_levels extends Migration
{
    public function safeUp()
    {
        // Population a building provides while it exists (housing buildings).
        $this->addColumn(
            '{{%building_levels}}',
            'population_capacity',
            $this->integer()->notNull()->defaultValue(0)->after('capacity')
        );

        // Population a building uses while it exists (production and other buildings).
        $this->addColumn(
            '{{%building_levels}}',
            'population_cost',
            $this->integer()->notNull()->defaultValue(0)->after('population_capacity')
        );
    }

    public function safeDown()
    {
        $this->dropColumn('{{%building_levels}}', 'population_cost');
        $this->dropColumn('{{%building_levels}}', 'population_capacity');
    }
}
