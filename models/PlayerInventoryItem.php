<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player_inventory_items".
 *
 * @property int $id
 * @property int $player_inventory_id
 * @property int $item_id
 * @property int $quantity
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property PlayerInventory $playerInventory
 * @property Item $item
 */
class PlayerInventoryItem extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player_inventory_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at'], 'default', 'value' => null],
            [['player_inventory_id', 'item_id'], 'required'],
            [['player_inventory_id', 'item_id', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['player_inventory_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlayerInventory::class, 'targetAttribute' => ['player_inventory_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
            [['quantity'], 'integer', 'min' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'player_inventory_id' => 'Player Inventory ID',
            'item_id' => 'Item ID',
            'quantity' => 'Quantity',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[PlayerInventory]].
     *
     * @return \yii\db\ActiveQuery|PlayerInventoryQuery
     */
    public function getPlayerInventory()
    {
        return $this->hasOne(PlayerInventory::class, ['id' => 'player_inventory_id']);
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
     * @return PlayerInventoryItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlayerInventoryItemQuery(get_called_class());
    }

}
