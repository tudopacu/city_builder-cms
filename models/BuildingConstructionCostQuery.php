<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BuildingConstructionCost]].
 *
 * @see BuildingConstructionCost
 */
class BuildingConstructionCostQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuildingConstructionCost[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuildingConstructionCost|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
