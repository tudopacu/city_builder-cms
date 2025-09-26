<?php

namespace app\modules\user;

/**
 * user module definition class
 */
class user extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\user\controllers';

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
