<?php

use app\models\PlayerInventoryItem;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PlayerInventoryItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Player Inventory Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-inventory-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Player Inventory Item', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'player_inventory_id',
                'filter' => Html::input('number', $searchModel->formName() . '[player_inventory_id]', $searchModel->player_inventory_id, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'item_id',
                'filter' => Html::input('number', $searchModel->formName() . '[item_id]', $searchModel->item_id, ['class' => 'form-control']),
                'value' => function($model) {
                    return $model->item ? $model->item->name : $model->item_id;
                }
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
                'urlCreator' => function ($action, PlayerInventoryItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
