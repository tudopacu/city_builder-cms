<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_recipe_inputs".
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $input_item_id
 * @property int $quantity
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property ItemRecipe $recipe
 * @property Item $inputItem
 */
class ItemRecipeInput extends CoreModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_recipe_inputs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recipe_id', 'input_item_id', 'quantity'], 'required'],
            [['recipe_id', 'input_item_id', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['recipe_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemRecipe::class, 'targetAttribute' => ['recipe_id' => 'id']],
            [['input_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['input_item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recipe_id' => 'Recipe ID',
            'input_item_id' => 'Input Item ID',
            'quantity' => 'Quantity',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Recipe]].
     *
     * @return \yii\db\ActiveQuery|ItemRecipeQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(ItemRecipe::class, ['id' => 'recipe_id']);
    }

    /**
     * Gets query for [[InputItem]].
     *
     * @return \yii\db\ActiveQuery|ItemQuery
     */
    public function getInputItem()
    {
        return $this->hasOne(Item::class, ['id' => 'input_item_id']);
    }

    /**
     * {@inheritdoc}
     * @return ItemRecipeInputQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemRecipeInputQuery(get_called_class());
    }
}
