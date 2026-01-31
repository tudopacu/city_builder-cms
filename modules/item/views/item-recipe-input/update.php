<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ItemRecipeInput $model */

$this->title = 'Update Item Recipe Input: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Item Recipe Inputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Input #' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-recipe-input-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
