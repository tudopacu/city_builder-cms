<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player_inventories".
 *
 * @property int $id
 * @property int $building_id
 * @property int $capacity
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Building $building
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
            [['building_id', 'capacity'], 'required'],
            [['building_id', 'capacity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Building::class, 'targetAttribute' => ['building_id' => 'id']],
            [['building_id'], 'validateStorageBuilding'],
            [['capacity'], 'integer', 'min' => 1],
        ];
    }

    /**
     * Validate that the building has storage category (id = 3)
     */
    public function validateStorageBuilding($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $building = Building::findOne($this->building_id);
            if ($building && $building->building_category_id != 3) {
                $this->addError($attribute, 'Only storage buildings (category ID 3) can be assigned to inventories.');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'building_id' => 'Building ID',
            'capacity' => 'Capacity',
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
