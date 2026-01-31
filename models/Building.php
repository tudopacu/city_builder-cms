<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buildings".
 *
 * @property int $id
 * @property string $name
 * @property string $image_url
 * @property string|null $description
 * @property int $width
 * @property int $length
 * @property int $building_category_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property BuildingCategory $buildingCategory
 * @property BuildingLevel[] $buildingLevels
 * @property PlayerBuilding[] $playerBuildings
 * @property BuildingProduction[] $buildingProductions
 */
class Building extends CoreModel
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buildings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_url', 'description', 'updated_at'], 'default', 'value' => null],
            [['name', 'width', 'length', 'building_category_id'], 'required'],
            [['description'], 'string'],
            [['width', 'length', 'building_category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image_url'], 'string', 'max' => 255],
            [['building_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingCategory::class, 'targetAttribute' => ['building_category_id' => 'id']],
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
            'image_url' => 'Image Url',
            'description' => 'Description',
            'width' => 'Width',
            'length' => 'Length',
            'building_category_id' => 'Building Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[BuildingCategory]].
     *
     * @return \yii\db\ActiveQuery|BuildingCategoryQuery
     */
    public function getBuildingCategory()
    {
        return $this->hasOne(BuildingCategory::class, ['id' => 'building_category_id']);
    }

    /**
     * Gets query for [[BuildingLevels]].
     *
     * @return \yii\db\ActiveQuery|BuildingLevelQuery
     */
    public function getBuildingLevels()
    {
        return $this->hasMany(BuildingLevel::class, ['building_id' => 'id']);
    }

    /**
     * Gets query for [[PlayerBuildings]].
     *
     * @return \yii\db\ActiveQuery|PlayerBuildingQuery
     */
    public function getPlayerBuildings()
    {
        return $this->hasMany(PlayerBuilding::class, ['building_id' => 'id']);
    }

    /**
     * Gets query for [[BuildingProductions]].
     *
     * @return \yii\db\ActiveQuery|BuildingProductionQuery
     */
    public function getBuildingProductions()
    {
        return $this->hasMany(BuildingProduction::class, ['building_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BuildingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BuildingQuery(get_called_class());
    }

}
