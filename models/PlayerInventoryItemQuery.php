<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PlayerInventoryItem]].
 *
 * @see PlayerInventoryItem
 */
class PlayerInventoryItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlayerInventoryItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlayerInventoryItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
