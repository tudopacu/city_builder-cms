<?php

namespace app\models;

/**
 * This is the model class for table "road_types".
 *
 * @property int $id
 * @property int $age_id
 * @property string|null $name
 * @property string $type
 * @property string|null $image_url
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Age $age
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at', 'image_url', 'name'], 'default', 'value' => null],
            [['type', 'age_id'], 'required'],
            [['age_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'image_url', 'name'], 'string', 'max' => 255],
            [['age_id'], 'exist', 'skipOnError' => true, 'targetClass' => Age::class, 'targetAttribute' => ['age_id' => 'id']],
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
            'type' => 'Type',
            'image_url' => 'Image Url',
            'age_id' => 'Age',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Age]].
     *
     * @return \yii\db\ActiveQuery|AgeQuery
     */
    public function getAge()
    {
        return $this->hasOne(Age::class, ['id' => 'age_id']);
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
