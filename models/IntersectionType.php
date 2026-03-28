<?php

namespace app\models;

/**
 * This is the model class for table "intersection_types".
 *
 * @property int $id
 * @property string $type
 * @property string|null $image_url
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Intersection[] $intersections
 */
class IntersectionType extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intersection_types';
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
     * Gets query for [[Intersections]].
     *
     * @return \yii\db\ActiveQuery|IntersectionQuery
     */
    public function getIntersections()
    {
        return $this->hasMany(Intersection::class, ['intersection_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return IntersectionTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IntersectionTypeQuery(get_called_class());
    }
}
