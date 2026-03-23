<?php

namespace app\modules\smartbill;

/**
 * smartbill module definition class
 */
class smartbill extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\smartbill\controllers';

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
