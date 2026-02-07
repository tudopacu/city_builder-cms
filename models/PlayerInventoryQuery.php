<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PlayerInventory]].
 *
 * @see PlayerInventory
 */
class PlayerInventoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlayerInventory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlayerInventory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
