<?php

use yii\db\Migration;

class m260404_092126_add_name_to_road_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%road_types}}', 'name', $this->string()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%road_types}}', 'name');
    }
}
