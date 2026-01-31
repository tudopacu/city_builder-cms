<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_recipes".
 *
 * @property int $id
 * @property int $output_item_id
 * @property int $production_time_seconds
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Item $outputItem
 * @property ItemRecipeInput[] $itemRecipeInputs
 * @property Item[] $items
 */
class ItemRecipe extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_recipes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['output_item_id', 'production_time_seconds'], 'required'],
            [['output_item_id', 'production_time_seconds'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['output_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['output_item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'output_item_id' => 'Output Item ID',
            'production_time_seconds' => 'Production Time (seconds)',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[OutputItem]].
     *
     * @return \yii\db\ActiveQuery|ItemQuery
     */
    public function getOutputItem()
    {
        return $this->hasOne(Item::class, ['id' => 'output_item_id']);
    }

    /**
     * Gets query for [[ItemRecipeInputs]].
     *
     * @return \yii\db\ActiveQuery|ItemRecipeInputQuery
     */
    public function getItemRecipeInputs()
    {
        return $this->hasMany(ItemRecipeInput::class, ['recipe_id' => 'id']);
    }

    /**
     * Gets query for [[Items]] through item_recipe_id in items table.
     *
     * @return \yii\db\ActiveQuery|ItemQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['item_recipe_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ItemRecipeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemRecipeQuery(get_called_class());
    }
}
