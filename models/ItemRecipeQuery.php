<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ItemRecipe]].
 *
 * @see ItemRecipe
 */
class ItemRecipeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ItemRecipe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ItemRecipe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
