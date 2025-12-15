<?php

use app\models\Terrain;
use kartik\daterange\DateRangePicker;
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
                'attribute' => 'map_name',
                'label' => 'Map',
                'value' => function ($model) {
                    return $model->map
                        ? $model->map->id . '-' . $model->map->name
                        : '(not set)';
                },
                'filter' => Html::activeTextInput($searchModel, 'map_name', [
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'tile_type',
                'label' => 'Tile',
                'value' => function ($model) {
                    return $model->tile
                        ? $model->tile->id . '-' . $model->tile->type
                        : '(not set)';
                },
                'filter' => Html::activeTextInput($searchModel, 'tile_type', [
                    'class' => 'form-control',
                ]),
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
