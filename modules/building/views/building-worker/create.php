<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingWorker $model */

$this->title = 'Create Building Worker';
$this->params['breadcrumbs'][] = ['label' => 'Building Workers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-worker-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
