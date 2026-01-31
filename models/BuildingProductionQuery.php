<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BuildingProduction]].
 *
 * @see BuildingProduction
 */
class BuildingProductionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuildingProduction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuildingProduction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
