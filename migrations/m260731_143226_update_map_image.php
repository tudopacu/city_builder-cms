<?php

use yii\db\Migration;

class m260731_143226_update_map_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%maps}}', 'image_url', $this->string()->after('name')->null());
        $this->dropColumn('{{%tiles}}', 'image_url');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%tiles}}', 'image_url', $this->string()->after('type')->null());
        $this->dropColumn('{{%map}}', 'image_url');
    }
}
