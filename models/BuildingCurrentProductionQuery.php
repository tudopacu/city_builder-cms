<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BuildingCurrentProduction]].
 *
 * @see BuildingCurrentProduction
 */
class BuildingCurrentProductionQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return BuildingCurrentProduction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuildingCurrentProduction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
