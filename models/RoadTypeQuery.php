<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RoadType]].
 *
 * @see RoadType
 */
class RoadTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RoadType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RoadType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
