<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ItemRecipeInput]].
 *
 * @see ItemRecipeInput
 */
class ItemRecipeInputQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ItemRecipeInput[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ItemRecipeInput|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
