<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingLevel $model */

$this->title = 'Update Building Level: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="building-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
