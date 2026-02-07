<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player_inventories".
 *
 * @property int $id
 * @property int $player_id
 * @property int $player_building_id
 * @property int $capacity
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Player $player
 * @property PlayerBuilding $playerBuilding
 * @property PlayerInventoryItem[] $playerInventoryItems
 */
class PlayerInventory extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player_inventories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at'], 'default', 'value' => null],
            [['player_id', 'player_building_id', 'capacity'], 'required'],
            [['player_id', 'player_building_id', 'capacity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::class, 'targetAttribute' => ['player_id' => 'id']],
            [['player_building_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlayerBuilding::class, 'targetAttribute' => ['player_building_id' => 'id']],
            [['capacity'], 'integer', 'min' => 1],
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
            'player_building_id' => 'Player Building',
            'capacity' => 'Capacity',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * Gets query for [[PlayerInventoryItems]].
     *
     * @return \yii\db\ActiveQuery|PlayerInventoryItemQuery
     */
    public function getPlayerInventoryItems()
    {
        return $this->hasMany(PlayerInventoryItem::class, ['player_inventory_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PlayerInventoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlayerInventoryQuery(get_called_class());
    }

}
