<?php

use app\models\Building;
use app\models\BuildingConstructionCost;
use app\models\Item;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\BuildingConstructionCostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Building Construction Costs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-construction-cost-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Building Construction Cost', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'building_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->building
                        ? Html::a($model->building->name, ['/building/manage/view', 'id' => $model->building_id])
                        : $model->building_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[building_id]',
                    $searchModel->building_id,
                    ArrayHelper::map(Building::find()->orderBy('name')->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Select Building']
                ),
            ],
            [
                'attribute' => 'item_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->item
                        ? Html::a($model->item->name, ['/item/manage/view', 'id' => $model->item_id])
                        : $model->item_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[item_id]',
                    $searchModel->item_id,
                    ArrayHelper::map(Item::find()->orderBy('name')->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Select Item']
                ),
            ],
            [
                'attribute' => 'quantity',
                'filter' => Html::input('number', $searchModel->formName() . '[quantity]', $searchModel->quantity, ['class' => 'form-control']),
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
                'urlCreator' => function ($action, BuildingConstructionCost $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
