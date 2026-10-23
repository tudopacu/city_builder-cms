<?php

use yii\db\Migration;

class m261023_000000_add_tile_coordinates_to_maps extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            '{{%maps}}',
            'tile_x',
            $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->after('length')
        );
        $this->addColumn(
            '{{%maps}}',
            'tile_y',
            $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->after('tile_x')
        );
    }

    public function safeDown()
    {
        $this->dropColumn('{{%maps}}', 'tile_y');
        $this->dropColumn('{{%maps}}', 'tile_x');
    }
}
