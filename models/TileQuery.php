<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tile]].
 *
 * @see Tile
 */
class TileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
