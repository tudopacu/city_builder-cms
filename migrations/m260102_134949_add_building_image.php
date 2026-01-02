<?php

use yii\db\Migration;

class m260102_134949_add_building_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%buildings}}', 'image_url', $this->string()->after('name')->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%buildings}}', 'image_url');
    }
}
