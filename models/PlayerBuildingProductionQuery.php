<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PlayerBuildingProduction]].
 *
 * @see PlayerBuildingProduction
 */
class PlayerBuildingProductionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlayerBuildingProduction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlayerBuildingProduction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
