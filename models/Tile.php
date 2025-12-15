<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiles".
 *
 * @property int $id
 * @property string $type
 * @property string|null $image_url
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Terrain[] $terrains
 */
class Tile extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_url', 'updated_at'], 'default', 'value' => null],
            [['type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'image_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'image_url' => 'Image Url',
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
        return $this->hasMany(Terrain::class, ['tile_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TileQuery(get_called_class());
    }

}
