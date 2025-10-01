<?php

namespace app\modules\map;

/**
 * map module definition class
 */
class map extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\map\controllers';

    public $defaultRoute = 'manage';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
