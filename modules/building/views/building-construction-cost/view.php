<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\BuildingConstructionCost $model */

$this->title = 'Building Construction Cost #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Construction Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="building-construction-cost-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this building construction cost?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Go to building', ['manage/view', 'id' => $model->building_id], ['class' => 'btn btn-primary']) ?>
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
            'quantity',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
