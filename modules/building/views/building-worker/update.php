<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingWorker $model */

$this->title = 'Update Building Worker: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Workers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="building-worker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
