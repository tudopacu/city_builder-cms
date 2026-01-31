<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building_construction_costs".
 *
 * @property int $id
 * @property int $building_id
 * @property int $item_id
 * @property int $quantity
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Building $building
 * @property Item $item
 */
class BuildingConstructionCost extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'building_construction_costs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['building_id', 'item_id', 'quantity'], 'required'],
            [['building_id', 'item_id', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Building::class, 'targetAttribute' => ['building_id' => 'id']],
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
            'building_id' => 'Building',
            'item_id' => 'Item',
            'quantity' => 'Quantity',
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
     * @return BuildingConstructionCostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuildingConstructionCostQuery(get_called_class());
    }
}
