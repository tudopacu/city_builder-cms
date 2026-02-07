<?php

use app\models\Map;
use app\models\Terrain;
use app\models\Tile;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
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
            [
                'attribute' => 'id',
                'filter' => Html::input('number', $searchModel->formName() . '[id]', $searchModel->id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'map_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->map
                        ? Html::a($model->map->name, ['/map/manage/view', 'id' => $model->map_id])
                        : $model->map_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[map_id]',
                    $searchModel->map_id,
                    ArrayHelper::map(Map::find()->orderBy('name')->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Select Map']
                ),
            ],
            [
                'attribute' => 'tile_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->tile
                        ? Html::a($model->tile->type, ['/map/tile/view', 'id' => $model->tile_id])
                        : $model->tile_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[tile_id]',
                    $searchModel->tile_id,
                    ArrayHelper::map(Tile::find()->orderBy('type')->all(), 'id', 'type'),
                    ['class' => 'form-control', 'prompt' => 'Select Tile']
                ),
            ],
            'x',
            'y',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at_range',
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'timePicker' => true,
                        'timePicker24Hour' => true,
                        'timePickerIncrement' => 15,
                        'locale' => [
                            'format' => 'Y-m-d H:i',
                            'separator' => ' - ',
                        ],
                    ],
                ]),
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'updated_at_range',
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'timePicker' => true,
                        'timePicker24Hour' => true,
                        'timePickerIncrement' => 15,
                        'locale' => [
                            'format' => 'Y-m-d H:i',
                            'separator' => ' - ',
                        ],
                    ],
                ]),
            ],
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
