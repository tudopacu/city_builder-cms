<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Map $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="map-view">

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
            'name',
            'width',
            'length',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h3>Terrains</h3>
    <?php if ($model->terrains): ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => array_map(function ($input) {
                return [
                    'label' => $input->tile ? $input->tile->type : 'Tile #' . $input->tile_id,
                    'value' => 'Coordinates: x: ' . $input->x . ', y: ' . $input->y,
                ];
            }, $model->terrains),
        ]) ?>
    <?php else: ?>
        <p class="text-muted">No terrains defined for this map.</p>
    <?php endif; ?>

</div>
