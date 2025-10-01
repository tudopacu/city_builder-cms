<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Terrain $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Terrains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="terrain-view">

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
                'attribute' => 'map_id',
                'value' => function ($model) {
                    return $model->map->name ?? '(not set)';
                },
            ],
            [
                'attribute' => 'tile_id',
                'value' => function ($model) {
                    return $model->tile->type ?? '(not set)';
                },
            ],
            'x',
            'y',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
