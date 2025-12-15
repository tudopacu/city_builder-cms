<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingCategory $model */

$this->title = 'Update Building Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Building Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="building-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
