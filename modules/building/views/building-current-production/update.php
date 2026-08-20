<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingCurrentProduction $model */

$this->title = 'Update Building Current Production';
$this->params['breadcrumbs'][] = ['label' => 'Building Current Productions', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => 'View',
    'url' => [
        'view',
        'player_id' => $model->player_id,
        'player_building_id' => $model->player_building_id,
        'building_production_id' => $model->building_production_id,
    ],
];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="building-current-production-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
