<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building_categories".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Building[] $buildings
 */
class BuildingCategory extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'building_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'updated_at'], 'default', 'value' => null],
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Buildings]].
     *
     * @return \yii\db\ActiveQuery|BuildingQuery
     */
    public function getBuildings()
    {
        return $this->hasMany(Building::class, ['building_category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BuildingCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuildingCategoryQuery(get_called_class());
    }

}
