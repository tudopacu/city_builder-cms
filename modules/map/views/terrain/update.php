<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Terrain $model */

$this->title = 'Update Terrain: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Terrains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="terrain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
