<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building_workers".
 *
 * @property int $id
 * @property int $building_id
 * @property int $item_id
 * @property string $name
 * @property int $range
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Building $building
 * @property Item $item
 */
class BuildingWorker extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'building_workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'updated_at'], 'default', 'value' => null],
            [['building_id', 'item_id', 'name', 'range'], 'required'],
            [['building_id', 'item_id', 'range'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'range' => 'Range',
            'description' => 'Description',
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
     * @return BuildingWorkerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuildingWorkerQuery(get_called_class());
    }
}
