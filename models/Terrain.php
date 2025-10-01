<?php

namespace app\models;

/**
 * This is the model class for table "terrains".
 *
 * @property int $id
 * @property int $map_id
 * @property int $tile_id
 * @property int $x
 * @property int $y
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Map $maps
 * @property Tile $tiles
 */
class Terrain extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'terrains';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['map_id', 'tile_id', 'x', 'y'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['map_id', 'tile_id', 'x', 'y'], 'integer'],
            [['map_id', 'x', 'y'], 'unique', 'targetAttribute' => ['map_id', 'x', 'y']],
            [['map_id'], 'exist', 'skipOnError' => true, 'targetClass' => Map::class, 'targetAttribute' => ['map_id' => 'id']],
            [['tile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tile::class, 'targetAttribute' => ['tile_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'map_id' => 'Map',
            'tile_id' => 'Tile',
            'x' => 'X',
            'y' => 'Y',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Maps]].
     *
     * @return \yii\db\ActiveQuery|MapQuery
     */
    public function getMap()
    {
        return $this->hasOne(Map::class, ['id' => 'map_id']);
    }

    /**
     * Gets query for [[Tiles]].
     *
     * @return \yii\db\ActiveQuery|TileQuery
     */
    public function getTile()
    {
        return $this->hasOne(Tile::class, ['id' => 'tile_id']);
    }

    /**
     * {@inheritdoc}
     * @return TerrainQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TerrainQuery(get_called_class());
    }

}
