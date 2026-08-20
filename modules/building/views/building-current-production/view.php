<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\BuildingCurrentProduction $model */

$this->title = 'Building Current Production #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Current Productions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="building-current-production-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'player_id',
                'value' => $model->player ? $model->player->username . ' (ID: ' . $model->player_id . ')' : $model->player_id,
            ],
            [
                'attribute' => 'player_building_id',
                'value' => $model->playerBuilding
                    ? ($model->playerBuilding->building ? $model->playerBuilding->building->name : '?') . ' (ID: ' . $model->player_building_id . ')'
                    : $model->player_building_id,
            ],
            [
                'attribute' => 'building_production_id',
                'value' => $model->buildingProduction
                    ? ($model->buildingProduction->building ? $model->buildingProduction->building->name : '?')
                      . ' → ' . ($model->buildingProduction->item ? $model->buildingProduction->item->name : '?')
                      . ' (ID: ' . $model->building_production_id . ')'
                    : $model->building_production_id,
            ],
            'end_time:datetime',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
