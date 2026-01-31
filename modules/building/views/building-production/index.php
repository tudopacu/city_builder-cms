<?php

use app\models\Building;
use app\models\BuildingProduction;
use app\models\Item;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\BuildingProductionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Building Productions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-production-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Building Production', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'building_id',
                'value' => function($model) {
                    return $model->building ? $model->building->name : $model->building_id;
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
                'value' => function($model) {
                    return $model->item ? $model->item->name : $model->item_id;
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
                'attribute' => 'quantity',
                'filter' => Html::input('number', $searchModel->formName() . '[quantity]', $searchModel->quantity, ['class' => 'form-control']),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BuildingProduction $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
