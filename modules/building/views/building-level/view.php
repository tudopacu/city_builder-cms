<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\BuildingLevel $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="building-level-view">

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
            'building_id',
            'level',
            'build_time_seconds:datetime',
            [
                'attribute' => 'image_url',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!$model->image_url) return '';
                    $fullUrl = IMAGE_BASE_URL . $model->image_url;
                    return Html::a($model->image_url, $fullUrl) . ' ' .
                        Html::a(Html::img($fullUrl, ['style' => 'max-width:150px;max-height:150px;']), $fullUrl);
                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
