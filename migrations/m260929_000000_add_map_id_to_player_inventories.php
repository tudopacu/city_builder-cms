<?php

use yii\db\Migration;
use yii\db\Query;

class m260929_000000_add_map_id_to_player_inventories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add the column as nullable first so existing inventories can be backfilled.
        $this->addColumn('{{%player_inventories}}', 'map_id', $this->integer());

        $inventoryMaps = (new Query())
            ->select(['inventory_id' => 'pi.id', 'map_id' => 'pb.map_id'])
            ->from(['pi' => '{{%player_inventories}}'])
            ->innerJoin(['pb' => '{{%player_buildings}}'], 'pb.id = pi.player_building_id')
            ->all($this->db);

        foreach ($inventoryMaps as $inventoryMap) {
            $this->update(
                '{{%player_inventories}}',
                ['map_id' => $inventoryMap['map_id']],
                ['id' => $inventoryMap['inventory_id']]
            );
        }

        $this->alterColumn('{{%player_inventories}}', 'map_id', $this->integer()->notNull());

        $this->addForeignKey(
            'fk_pi_map',
            '{{%player_inventories}}',
            'map_id',
            '{{%maps}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_pi_map', '{{%player_inventories}}');
        $this->dropColumn('{{%player_inventories}}', 'map_id');
    }
}
