<?php

namespace app\modules\age;

/**
 * age module definition class
 */
class age extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\age\controllers';

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
