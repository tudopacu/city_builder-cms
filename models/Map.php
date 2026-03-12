<?php

namespace app\models;

/**
 * This is the model class for table "maps".
 *
 * @property int $id
 * @property string $name
 * @property int $width
 * @property int $length
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
            [['name', 'width', 'length'], 'required'],
            [['width', 'length'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'width' => 'Width',
            'length' => 'Length',
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
