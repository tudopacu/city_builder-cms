<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Intersection]].
 *
 * @see Intersection
 */
class IntersectionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Intersection[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Intersection|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
