<?php

namespace app\modules\item\controllers;

use yii\web\Controller;

/**
 * Default controller for the `item` module
 */
class ManageController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['/item/item']);
    }
}
