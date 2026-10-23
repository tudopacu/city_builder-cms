<?php

namespace app\models;

/**
 * This is the model class for table "maps".
 *
 * @property int $id
 * @property string $name
 * @property string|null $image_url
 * @property int $width
 * @property int $length
 * @property int $tile_x
 * @property int $tile_y
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Terrain[] $terrains
 * @property Intersection[] $intersections
 */
class Map extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image_url', 'width', 'length', 'tile_x', 'tile_y'], 'required'],
            [['width', 'length'], 'integer'],
            [['tile_x', 'tile_y'], 'integer', 'min' => 0, 'max' => 65535],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image_url'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image_url' => 'Image Url',
            'width' => 'Width',
            'length' => 'Length',
            'tile_x' => 'Tile X',
            'tile_y' => 'Tile Y',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Terrains]].
     *
     * @return \yii\db\ActiveQuery|TerrainQuery
     */
    public function getTerrains()
    {
        return $this->hasMany(Terrain::class, ['map_id' => 'id']);
    }

    /**
     * Gets query for [[Intersections]].
     *
     * @return \yii\db\ActiveQuery|IntersectionQuery
     */
    public function getIntersections()
    {
        return $this->hasMany(Intersection::class, ['map_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return MapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MapQuery(get_called_class());
    }

}
