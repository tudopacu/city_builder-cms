<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building_levels".
 *
 * @property int $id
 * @property int $building_id
 * @property int $level
 * @property int $build_time_seconds
 * @property string|null $image_url
 *
 * @property Building $building
 */
class BuildingLevel extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'building_levels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_url'], 'default', 'value' => null],
            [['building_id', 'level', 'build_time_seconds'], 'required'],
            [['building_id', 'level', 'build_time_seconds'], 'integer'],
            [['image_url'], 'string', 'max' => 255],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Building::class, 'targetAttribute' => ['building_id' => 'id']],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'building_id' => 'Building',
            'level' => 'Level',
            'build_time_seconds' => 'Build Time in Seconds',
            'image_url' => 'Image Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Building]].
     *
     * @return \yii\db\ActiveQuery|BuildingQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(Building::class, ['id' => 'building_id']);
    }

    /**
     * {@inheritdoc}
     * @return BuildingLevelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuildingLevelQuery(get_called_class());
    }

}
