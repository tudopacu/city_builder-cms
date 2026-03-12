<?php

namespace app\models;

/**
 * This is the model class for table "roads".
 *
 * @property int $id
 * @property int|null $start_intersection_id
 * @property int|null $end_intersection_id
 * @property int|null $road_type_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Intersection $startIntersection
 * @property Intersection $endIntersection
 * @property RoadType $roadType
 */
class Road extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_intersection_id', 'end_intersection_id', 'road_type_id', 'updated_at'], 'default', 'value' => null],
            [['start_intersection_id', 'end_intersection_id', 'road_type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['start_intersection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intersection::class, 'targetAttribute' => ['start_intersection_id' => 'id']],
            [['end_intersection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intersection::class, 'targetAttribute' => ['end_intersection_id' => 'id']],
            [['road_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RoadType::class, 'targetAttribute' => ['road_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_intersection_id' => 'Start Intersection',
            'end_intersection_id' => 'End Intersection',
            'road_type_id' => 'Road Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[StartIntersection]].
     *
     * @return \yii\db\ActiveQuery|IntersectionQuery
     */
    public function getStartIntersection()
    {
        return $this->hasOne(Intersection::class, ['id' => 'start_intersection_id']);
    }

    /**
     * Gets query for [[EndIntersection]].
     *
     * @return \yii\db\ActiveQuery|IntersectionQuery
     */
    public function getEndIntersection()
    {
        return $this->hasOne(Intersection::class, ['id' => 'end_intersection_id']);
    }

    /**
     * Gets query for [[RoadType]].
     *
     * @return \yii\db\ActiveQuery|RoadTypeQuery
     */
    public function getRoadType()
    {
        return $this->hasOne(RoadType::class, ['id' => 'road_type_id']);
    }

    /**
     * {@inheritdoc}
     * @return RoadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoadQuery(get_called_class());
    }
}
