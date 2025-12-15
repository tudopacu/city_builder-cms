<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

class CoreModel extends ActiveRecord
{
    public $created_at_range;
    public $updated_at_range;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}