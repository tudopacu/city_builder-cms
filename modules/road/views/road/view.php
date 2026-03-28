<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Road $model */

$this->title = 'Road #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="road-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this road?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'start_intersection_id',
                'value' => $model->startIntersection ? 'Intersection #' . $model->start_intersection_id : $model->start_intersection_id,
            ],
            [
                'attribute' => 'end_intersection_id',
                'value' => $model->endIntersection ? 'Intersection #' . $model->end_intersection_id : $model->end_intersection_id,
            ],
            [
                'attribute' => 'road_type_id',
                'value' => $model->roadType ? $model->roadType->type : $model->road_type_id,
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
