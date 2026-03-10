<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\PlayerBuildingProduction $model */

$this->title = 'Player Building Production #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Player Building Productions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="player-building-production-view">

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
                'attribute' => 'player_building_id',
                'value' => $model->playerBuilding
                    ? ($model->playerBuilding->building ? $model->playerBuilding->building->name : 'N/A') . ' (ID: ' . $model->player_building_id . ')'
                    : $model->player_building_id,
            ],
            [
                'attribute' => 'item_id',
                'value' => $model->item ? $model->item->name : $model->item_id,
            ],
            'end_time',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
