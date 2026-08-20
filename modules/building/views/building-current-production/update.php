<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingCurrentProduction $model */

$this->title = 'Update Building Current Production #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Current Productions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="building-current-production-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
