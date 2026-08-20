<?php

use app\models\BuildingCurrentProduction;
use app\models\BuildingProduction;
use app\models\Player;
use app\models\PlayerBuilding;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\BuildingCurrentProductionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Building Current Productions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-current-production-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Building Current Production', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'player_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->player
                        ? Html::a($model->player->username . ' (ID: ' . $model->player_id . ')', ['/player/manage/view', 'id' => $model->player_id])
                        : '(not set)';
                },
                'filter' => Html::input('number', $searchModel->formName() . '[player_id]', $searchModel->player_id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'player_building_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->playerBuilding
                        ? Html::a(
                            ($model->playerBuilding->building ? $model->playerBuilding->building->name : '?') . ' (ID: ' . $model->player_building_id . ')',
                            ['/player/player-building/view', 'id' => $model->player_building_id]
                          )
                        : '(not set)';
                },
                'filter' => Html::input('number', $searchModel->formName() . '[player_building_id]', $searchModel->player_building_id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'building_production_id',
                'format' => 'raw',
                'value' => function($model) {
                    if (!$model->buildingProduction) {
                        return '(not set)';
                    }
                    $bp = $model->buildingProduction;
                    $label = ($bp->building ? $bp->building->name : '?') . ' → ' . ($bp->item ? $bp->item->name : '?') . ' (ID: ' . $model->building_production_id . ')';
                    return Html::a($label, ['/building/building-production/view', 'id' => $model->building_production_id]);
                },
                'filter' => Html::input('number', $searchModel->formName() . '[building_production_id]', $searchModel->building_production_id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'end_time',
                'format' => 'datetime',
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'end_time_range',
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
                'attribute' => 'status',
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[status]',
                    $searchModel->status,
                    BuildingCurrentProduction::statusOptions(),
                    ['class' => 'form-control', 'prompt' => 'All']
                ),
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BuildingCurrentProduction $model, $key, $index, $column) {
                    return Url::toRoute([
                        $action,
                        'player_id' => $model->player_id,
                        'player_building_id' => $model->player_building_id,
                        'building_production_id' => $model->building_production_id,
                    ]);
                },
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
