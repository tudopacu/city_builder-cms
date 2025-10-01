<?php

use app\models\Terrain;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TerrainSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Terrains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terrain-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Terrain', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Terrain $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
