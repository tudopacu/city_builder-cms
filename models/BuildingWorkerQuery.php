<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BuildingWorker]].
 *
 * @see BuildingWorker
 */
class BuildingWorkerQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return BuildingWorker[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuildingWorker|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
