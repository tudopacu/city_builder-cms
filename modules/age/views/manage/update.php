<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Age $model */

$this->title = 'Update Age: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="age-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
