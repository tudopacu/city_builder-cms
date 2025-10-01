<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Terrain]].
 *
 * @see Terrain
 */
class TerrainQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Terrain[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Terrain|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
