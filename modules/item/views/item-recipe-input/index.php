<?php

use app\models\Item;
use app\models\ItemRecipe;
use app\models\ItemRecipeInput;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ItemRecipeInputSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Item Recipe Inputs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-recipe-input-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item Recipe Input', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'recipe_id',
                'value' => function($model) {
                    return $model->recipe ? $model->recipe->item->name. ' recipe' : $model->recipe_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[recipe_id]',
                    $searchModel->recipe_id,
                    ArrayHelper::map(ItemRecipe::find()->all(), 'id', 'item.name'),
                    ['class' => 'form-control', 'prompt' => 'Select recipe']
                ),
            ],
            [
                'attribute' => 'input_item_id',
                'value' => function($model) {
                    return $model->inputItem ? $model->inputItem->name : $model->input_item_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[input_item_id]',
                    $searchModel->input_item_id,
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
                'urlCreator' => function ($action, ItemRecipeInput $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
