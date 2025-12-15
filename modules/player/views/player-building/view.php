<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\PlayerBuilding $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Player Buildings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="player-building-view">

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
                'label' => 'Player',
                'attribute' => 'player_id',
                'value' => function ($model) {
                    return $model->player->id . '-' . $model->player->username ?? '(not set)';
                },
            ],
            [
                'label' => 'Map',
                'attribute' => 'map_id',
                'value' => function ($model) {
                    return $model->map->id . '-' .$model->map->name ?? '(not set)';
                },
            ],
            [
                'label' => 'building',
                'attribute' => 'building_id',
                'value' => function ($model) {
                    return $model->building->id . '-' . $model->building->name ?? '(not set)';
                },
            ],
            [
                'label' => 'Building Level',
                'attribute' => 'building_level_id',
                'value' => function ($model) {
                    return $model->buildingLevel->level ?? '(not set)';
                },
            ],
            'x',
            'y',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
