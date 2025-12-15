<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BuildingLevel]].
 *
 * @see BuildingLevel
 */
class BuildingLevelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuildingLevel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuildingLevel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
