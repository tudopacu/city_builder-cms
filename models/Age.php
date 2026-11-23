<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ages".
 *
 * @property int $id
 * @property string $name
 * @property string $period
 * @property string|null $description
 * @property int $sort_order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Building[] $buildings
 * @property Item[] $items
 * @property RoadType[] $roadTypes
 */
class Age extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'updated_at'], 'default', 'value' => null],
            [['name', 'period'], 'required'],
            [['description'], 'string'],
            [['sort_order'], 'integer'],
            [['sort_order'], 'default', 'value' => 0],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'period'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'period' => 'Period',
            'description' => 'Description',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Sort order to suggest for a new age: places it after the current last one.
     *
     * @return int
     */
    public static function getNextSortOrder()
    {
        return (int)self::find()->max('sort_order') + 10;
    }

    /**
     * Ages in chronological order as [id => name], for dropdowns.
     *
     * @return array
     */
    public static function getDropdownList()
    {
        return ArrayHelper::map(self::find()->select(['id', 'name'])->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])->all(), 'id', 'name');
    }

    /**
     * Gets query for [[Buildings]].
     *
     * @return \yii\db\ActiveQuery|BuildingQuery
     */
    public function getBuildings()
    {
        return $this->hasMany(Building::class, ['age_id' => 'id']);
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery|ItemQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['age_id' => 'id']);
    }

    /**
     * Gets query for [[RoadTypes]].
     *
     * @return \yii\db\ActiveQuery|RoadTypeQuery
     */
    public function getRoadTypes()
    {
        return $this->hasMany(RoadType::class, ['age_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AgeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgeQuery(get_called_class());
    }
}
