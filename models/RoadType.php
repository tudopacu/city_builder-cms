<?php

namespace app\models;

/**
 * This is the model class for table "road_types".
 *
 * @property int $id
 * @property string $type
 * @property string|null $image_url
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Road[] $roads
 */
class RoadType extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'road_types';
    }

    public static function typeList()
    {
        return [
            'road-tl-br' => 'road-tl-br',
            'road-bl-tr' => 'road-bl-tr',
            'bend-bl-br' => 'bend-bl-br',
            'bend-br-tr' => 'bend-br-tr',
            'bend-tr-tl' => 'bend-tr-tl',
            'bend-tr-br' => 'bend-tr-br',
            't-tr' => 't-tr',
            't-br' => 't-br',
            't-bl' => 't-bl',
            't-tl' => 't-tl',
            'cross' => 'cross',
            'end-tr' => 'end-tr',
            'end-br' => 'end-br',
            'end-bl' => 'end-bl',
            'end-tl' => 'end-tl',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at', 'image_url'], 'default', 'value' => null],
            [['type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'image_url'], 'string', 'max' => 255],
            [['type'], 'in', 'range' => array_keys(self::typeList()), 'skipOnEmpty' => true],
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
     * Gets query for [[Roads]].
     *
     * @return \yii\db\ActiveQuery|RoadQuery
     */
    public function getRoads()
    {
        return $this->hasMany(Road::class, ['road_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RoadTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoadTypeQuery(get_called_class());
    }
}
