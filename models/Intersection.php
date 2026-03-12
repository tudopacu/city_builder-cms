<?php

namespace app\models;

/**
 * This is the model class for table "intersections".
 *
 * @property int $id
 * @property int|null $map_id
 * @property int|null $player_id
 * @property int $x
 * @property int $y
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Map $map
 * @property Player $player
 * @property Road[] $startRoads
 * @property Road[] $endRoads
 */
class Intersection extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intersections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['map_id', 'player_id', 'updated_at'], 'default', 'value' => null],
            [['x', 'y'], 'required'],
            [['map_id', 'player_id', 'x', 'y'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['map_id'], 'exist', 'skipOnError' => true, 'targetClass' => Map::class, 'targetAttribute' => ['map_id' => 'id']],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::class, 'targetAttribute' => ['player_id' => 'id']],
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
            'player_id' => 'Player',
            'x' => 'X',
            'y' => 'Y',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Map]].
     *
     * @return \yii\db\ActiveQuery|MapQuery
     */
    public function getMap()
    {
        return $this->hasOne(Map::class, ['id' => 'map_id']);
    }

    /**
     * Gets query for [[Player]].
     *
     * @return \yii\db\ActiveQuery|PlayerQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Player::class, ['id' => 'player_id']);
    }

    /**
     * Gets query for roads where this intersection is the start point.
     *
     * @return \yii\db\ActiveQuery|RoadQuery
     */
    public function getStartRoads()
    {
        return $this->hasMany(Road::class, ['start_intersection_id' => 'id']);
    }

    /**
     * Gets query for roads where this intersection is the end point.
     *
     * @return \yii\db\ActiveQuery|RoadQuery
     */
    public function getEndRoads()
    {
        return $this->hasMany(Road::class, ['end_intersection_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return IntersectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IntersectionQuery(get_called_class());
    }
}
