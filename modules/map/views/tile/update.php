<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tile $model */

$this->title = 'Update Tile: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
