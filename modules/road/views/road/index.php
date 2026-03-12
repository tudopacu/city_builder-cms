<?php

use app\models\Intersection;
use app\models\RoadType;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RoadSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Roads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="road-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Road', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => Html::input('number', $searchModel->formName() . '[id]', $searchModel->id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'start_intersection_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->startIntersection
                        ? Html::a('#' . $model->start_intersection_id, ['/road/intersection/view', 'id' => $model->start_intersection_id])
                        : $model->start_intersection_id;
                },
                'filter' => Html::input('number', $searchModel->formName() . '[start_intersection_id]', $searchModel->start_intersection_id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'end_intersection_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->endIntersection
                        ? Html::a('#' . $model->end_intersection_id, ['/road/intersection/view', 'id' => $model->end_intersection_id])
                        : $model->end_intersection_id;
                },
                'filter' => Html::input('number', $searchModel->formName() . '[end_intersection_id]', $searchModel->end_intersection_id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'road_type_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->roadType
                        ? Html::a($model->roadType->type, ['/road/manage/view', 'id' => $model->road_type_id])
                        : $model->road_type_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[road_type_id]',
                    $searchModel->road_type_id,
                    ArrayHelper::map(RoadType::find()->orderBy('type')->all(), 'id', 'type'),
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
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
