<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Intersection $model */

$this->title = 'Intersection #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Intersections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="intersection-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this intersection?',
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
                'value' => $model->map ? $model->map->name : $model->map_id,
            ],
            [
                'attribute' => 'player_id',
                'value' => $model->player ? $model->player->username : $model->player_id,
            ],
            'x',
            'y',
            [
                'attribute' => 'intersection_type_id',
                'value' => $model->intersectionType ? $model->intersectionType->type : $model->intersection_type_id,
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
