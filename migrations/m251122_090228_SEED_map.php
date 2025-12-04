<?php

use yii\db\Migration;

class m251122_090228_SEED_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * -----------------------------
         *  Seed tiles
         * -----------------------------
         */
        $this->batchInsert('{{%tiles}}', ['type', 'image_url'], [
            ['grass', '/images/tiles/grass.png'],
            ['water', '/images/tiles/water.png'],
            ['dirt', '/images/tiles/dirt.png'],
            ['road', '/images/tiles/road.png'],
        ]);

        // Fetch tile IDs for reference
        $tileIds = (new \yii\db\Query())
            ->select(['type', 'id'])
            ->from('{{%tiles}}')
            ->indexBy('type')
            ->all();

        /**
         * -----------------------------
         *  Create map (50x50)
         * -----------------------------
         */
        $this->insert('{{%maps}}', [
            'name' => 'Default Map',
            'width' => 50,
            'length' => 50,
        ]);

        $mapId = $this->db->getLastInsertID();

        /**
         * --------------------------------
         * Generate island terrain
         * --------------------------------
         */

        $width = 50;
        $height = 50;

        $centerX = $width / 2;
        $centerY = $height / 2;
        $maxRadius = min($centerX, $centerY) * 0.9;  // Slight margin for water

        // Dirt patch parameters
        $dirtRadius = 8;

        // Road line (horizontal center)
        $roadY = (int) floor($height / 2);

        $rows = [];

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {

                $walkable = true;
                $setX = rand(1,4);
                $setY = rand(1,6);

                // Road overrides everything
                if ($y === $roadY) {
                    $tileType = 'road';
                } else {
                    // Compute distance to center
                    $dx = $x - $centerX;
                    $dy = $y - $centerY;
                    $distance = sqrt($dx * $dx + $dy * $dy);

                    if ($distance > $maxRadius) {
                        $tileType = 'water';  // Sea
                        $walkable = false;
                    } elseif ($distance < $dirtRadius) {
                        $tileType = 'dirt';   // Dirt center
                    } else {
                        $tileType = 'grass';  // Island terrain
                    }
                }

                $rows[] = [
                    'map_id' => $mapId,
                    'tile_id' => $tileIds[$tileType]['id'],
                    'x' => $x,
                    'y' => $y,
                    'walkable' => $walkable,
                    'set_x' => $setX,
                    'set_y' => $setY
                ];
            }
        }

        // Insert in batches
        foreach (array_chunk($rows, 500) as $chunk) {
            $this->batchInsert('{{%terrains}}', ['map_id', 'tile_id', 'x', 'y', 'walkable', 'set_x', 'set_y'], $chunk);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove terrains belonging only to this map
        $mapId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%maps}}')
            ->where(['name' => 'Default Map'])
            ->scalar();

        if ($mapId) {
            $this->delete('{{%terrains}}', ['map_id' => $mapId]);
            $this->delete('{{%maps}}', ['id' => $mapId]);
        }

        // Remove inserted tiles
        $this->delete('{{%tiles}}', ['type' => ['grass', 'water', 'dirt', 'road']]);
    }
}
