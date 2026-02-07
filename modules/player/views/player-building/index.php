<?php

use app\models\PlayerBuilding;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PlayerBuildingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Player Buildings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-building-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Player Building', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'player_username',
                'label' => 'Player',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->player
                        ? Html::a($model->player->id . '-' . $model->player->username, ['view', 'id' => $model->player->id])
                        : '(not set)';
                },
                'filter' => Html::activeTextInput($searchModel, 'player_username', [
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'building_name',
                'label' => 'Building',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->building
                        ? Html::a($model->building->id . '-' . $model->building->name, ['/building/manage/view', 'id' => $model->building->id])
                        : '(not set)';
                },
                'filter' => Html::activeTextInput($searchModel, 'building_name', [
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'map_name',
                'label' => 'Map',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->map
                        ? Html::a($model->map->id . '-' . $model->map->name, ['/map/manage/view', 'id' => $model->map->id])
                        : '(not set)';
                },
                'filter' => Html::activeTextInput($searchModel, 'map_name', [
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'building_level',
                'label' => 'Level',
                'value' => function ($model) {
                    return $model->buildingLevel
                        ? $model->buildingLevel->level
                        : '(not set)';
                },
                'filter' => Html::activeTextInput($searchModel, 'building_level', [
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'x',
                'filter' => Html::input('number', $searchModel->formName() . '[x]', $searchModel->x, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'y',
                'filter' => Html::input('number', $searchModel->formName() . '[y]', $searchModel->y, ['class' => 'form-control']),
            ],
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
                'urlCreator' => function ($action, PlayerBuilding $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
