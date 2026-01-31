<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingProduction $model */

$this->title = 'Update Building Production: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Productions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="building-production-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
