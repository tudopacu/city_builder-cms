<?php

namespace app\modules\building;

/**
 * building module definition class
 */
class building extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\building\controllers';

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
