<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Road]].
 *
 * @see Road
 */
class RoadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Road[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Road|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
