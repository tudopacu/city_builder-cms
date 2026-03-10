<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player_building_productions".
 *
 * @property int $id
 * @property int $player_building_id
 * @property int $item_id
 * @property string $end_time
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property PlayerBuilding $playerBuilding
 * @property Item $item
 */
class PlayerBuildingProduction extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player_building_productions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at'], 'default', 'value' => null],
            [['player_building_id', 'item_id', 'end_time'], 'required'],
            [['player_building_id', 'item_id'], 'integer'],
            [['end_time', 'created_at', 'updated_at'], 'safe'],
            [['player_building_id'], 'unique'],
            [['player_building_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlayerBuilding::class, 'targetAttribute' => ['player_building_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'player_building_id' => 'Player Building',
            'item_id' => 'Item',
            'end_time' => 'End Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery|ItemQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    /**
     * {@inheritdoc}
     * @return PlayerBuildingProductionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlayerBuildingProductionQuery(get_called_class());
    }

}
