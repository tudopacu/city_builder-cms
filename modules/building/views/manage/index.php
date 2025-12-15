<?php

use app\models\Building;
use app\models\BuildingCategory;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BuildingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Buildings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Building', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => Html::input('number', $searchModel->formName() . '[id]', $searchModel->id, ['class' => 'form-control']),
            ],
            'name',
            'description:ntext',
            [
                'attribute' => 'width',
                'filter' => Html::input('number', $searchModel->formName() . '[width]', $searchModel->id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'length',
                'filter' => Html::input('number', $searchModel->formName() . '[length]', $searchModel->id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'building_category_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'building_category_id',
                    ArrayHelper::map(BuildingCategory::find()->select(['id', 'name'])->orderBy('name')->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']
                ),
                'label' => 'Building Category',
                'value' => function ($model) {
                    return $model->buildingCategory->name ?? '(not set)';
                },
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
                'urlCreator' => function ($action, Building $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
