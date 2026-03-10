<?php

use app\models\Item;
use app\models\PlayerBuilding;
use app\models\PlayerBuildingProduction;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PlayerBuildingProductionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Player Building Productions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-building-production-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Player Building Production', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'player_building_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->playerBuilding
                        ? Html::a($model->playerBuilding->building->name . ' (ID: ' . $model->player_building_id . ')', ['/player/player-building/view', 'id' => $model->player_building_id])
                        : '(not set)';
                },
                'filter' => Html::input('number', $searchModel->formName() . '[player_building_id]', $searchModel->player_building_id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'item_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->item
                        ? Html::a($model->item->name, ['/item/manage/view', 'id' => $model->item_id])
                        : '(not set)';
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[item_id]',
                    $searchModel->item_id,
                    ArrayHelper::map(Item::find()->orderBy('name')->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Select Item']
                ),
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
                'urlCreator' => function ($action, PlayerBuildingProduction $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
