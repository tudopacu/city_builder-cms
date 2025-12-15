<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player_buildings".
 *
 * @property int $id
 * @property int $player_id
 * @property int $building_id
 * @property int $map_id
 * @property int $building_level_id
 * @property int $x
 * @property int $y
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Building $building
 * @property BuildingLevel $buildingLevel
 * @property Map $map
 * @property Player $player
 */
class PlayerBuilding extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player_buildings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at'], 'default', 'value' => null],
            [['player_id', 'building_id', 'map_id', 'building_level_id', 'x', 'y'], 'required'],
            [['player_id', 'building_id', 'map_id', 'building_level_id', 'x', 'y'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['player_id', 'x', 'y'], 'unique', 'targetAttribute' => ['player_id', 'x', 'y']],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Building::class, 'targetAttribute' => ['building_id' => 'id']],
            [['building_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingLevel::class, 'targetAttribute' => ['building_level_id' => 'id']],
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
            'player_id' => 'Player',
            'building_id' => 'Building',
            'map_id' => 'Map',
            'building_level_id' => 'Building Level',
            'x' => 'X',
            'y' => 'Y',
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
     * Gets query for [[BuildingLevel]].
     *
     * @return \yii\db\ActiveQuery|BuildingLevelQuery
     */
    public function getBuildingLevel()
    {
        return $this->hasOne(BuildingLevel::class, ['id' => 'building_level_id']);
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
     * {@inheritdoc}
     * @return PlayerBuildingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlayerBuildingQuery(get_called_class());
    }

}
