<?php

use app\models\Item;
use app\models\ItemRecipe;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ItemRecipeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Item Recipes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-recipe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item Recipe', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'item_id',
                'value' => function($model) {
                    return $model->outputItem ? $model->outputItem->name : $model->item_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[item_id]',
                    $searchModel->item_id,
                    ArrayHelper::map(Item::find()->orderBy('name')->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Select Item']
                ),
            ],
            [
                'attribute' => 'production_time_seconds',
                'filter' => Html::input('number', $searchModel->formName() . '[production_time_seconds]', $searchModel->production_time_seconds, ['class' => 'form-control']),
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
                'template' => '{view} {update} {delete} {view-recipe-items}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                'view-recipe-items' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="fas fa-list"></i>',
                        ['/item/item-recipe-input/index', 'recipe_id' => $model->id],
                        [
                            'title' => 'View input items',
                            'data-pjax' => '0',
                        ]
                    );
                },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
