<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building_current_productions".
 *
 * @property int $player_id
 * @property int $player_building_id
 * @property int $building_production_id
 * @property string $end_time
 * @property string $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Player $player
 * @property PlayerBuilding $playerBuilding
 * @property BuildingProduction $buildingProduction
 */
class BuildingCurrentProduction extends CoreModel
{
    const STATUS_PENDING   = 'PENDING';
    const STATUS_DONE      = 'DONE';
    const STATUS_COLLECTED = 'COLLECTED';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'building_current_productions';
    }

    /**
     * {@inheritdoc}
     */
    public static function primaryKey()
    {
        return ['player_id', 'player_building_id', 'building_production_id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at'], 'default', 'value' => null],
            [['player_id', 'player_building_id', 'building_production_id', 'end_time', 'status'], 'required'],
            [['player_id', 'player_building_id', 'building_production_id'], 'integer'],
            [['end_time', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'in', 'range' => [self::STATUS_PENDING, self::STATUS_DONE, self::STATUS_COLLECTED]],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::class, 'targetAttribute' => ['player_id' => 'id']],
            [['player_building_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlayerBuilding::class, 'targetAttribute' => ['player_building_id' => 'id']],
            [['building_production_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingProduction::class, 'targetAttribute' => ['building_production_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'player_id' => 'Player',
            'player_building_id' => 'Player Building',
            'building_production_id' => 'Building Production',
            'end_time' => 'End Time',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Returns status options as array.
     */
    public static function statusOptions(): array
    {
        return [
            self::STATUS_PENDING   => 'Pending',
            self::STATUS_DONE      => 'Done',
            self::STATUS_COLLECTED => 'Collected',
        ];
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
     * Gets query for [[PlayerBuilding]].
     *
     * @return \yii\db\ActiveQuery|PlayerBuildingQuery
     */
    public function getPlayerBuilding()
    {
        return $this->hasOne(PlayerBuilding::class, ['id' => 'player_building_id']);
    }

    /**
     * Gets query for [[BuildingProduction]].
     *
     * @return \yii\db\ActiveQuery|BuildingProductionQuery
     */
    public function getBuildingProduction()
    {
        return $this->hasOne(BuildingProduction::class, ['id' => 'building_production_id']);
    }

    /**
     * {@inheritdoc}
     * @return BuildingCurrentProductionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuildingCurrentProductionQuery(get_called_class());
    }
}
