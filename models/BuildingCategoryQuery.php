<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BuildingCategory]].
 *
 * @see BuildingCategory
 */
class BuildingCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuildingCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuildingCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
