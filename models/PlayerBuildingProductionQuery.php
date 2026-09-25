<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PlayerBuildingProduction]].
 *
 * @see PlayerBuildingProduction
 */
class PlayerBuildingProductionQuery extends \yii\db\ActiveQuery
{
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
