<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RoadType $model */

$this->title = 'Update Road Type: ' . $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Road Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="road-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
