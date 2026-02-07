<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building_productions".
 *
 * @property int $id
 * @property int $building_id
 * @property int $item_id
 * @property int $production_time_seconds
 * @property int $quantity
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Building $building
 * @property Item $item
 */
class BuildingProduction extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'building_productions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['building_id', 'item_id', 'production_time_seconds'], 'required'],
            [['building_id', 'item_id', 'production_time_seconds', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['quantity'], 'default', 'value' => 1],
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
            'production_time_seconds' => 'Production Time (seconds)',
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
     * @return BuildingProductionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuildingProductionQuery(get_called_class());
    }
}
