<?php

use yii\db\Migration;

class m260925_120100_rename_building_current_productions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('{{%building_current_productions}}', '{{%player_building_productions}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('{{%player_building_productions}}', '{{%building_current_productions}}');
    }
}
