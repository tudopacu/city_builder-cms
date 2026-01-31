<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\BuildingProduction $model */

$this->title = 'Building Production #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Productions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="building-production-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this building production?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'building_id',
                'value' => $model->building ? $model->building->name : $model->building_id,
            ],
            [
                'attribute' => 'item_id',
                'value' => $model->item ? $model->item->name : $model->item_id,
            ],
            'production_time_seconds',
            'quantity',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
