<?php

use app\models\Building;
use app\models\Player;
use app\models\PlayerBuilding;
use app\models\PlayerInventory;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PlayerInventorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Player Inventories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Player Inventory', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'player_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->player
                        ? Html::a($model->player->username, ['/player/manage/view', 'id' => $model->player_id])
                        : $model->player_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[player_id]',
                    $searchModel->player_id,
                    ArrayHelper::map(Player::find()->orderBy('username')->all(), 'id', 'username'),
                    ['class' => 'form-control', 'prompt' => 'Select Player']
                ),
            ],
            [
                'attribute' => 'player_building_id',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->playerBuilding
                        ? Html::a($model->playerBuilding->building->name, ['/player/player-building/view', 'id' => $model->player_building_id])
                        : $model->player_building_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[player_building_id]',
                    $searchModel->player_building_id,
                    ArrayHelper::map(PlayerBuilding::find()->orderBy('building_id')->all(), 'player_building_id', 'building.name'),
                    ['class' => 'form-control', 'prompt' => 'Select Building']
                ),
            ],
            [
                'attribute' => 'capacity',
                'filter' => Html::input('number', $searchModel->formName() . '[capacity]', $searchModel->capacity, ['class' => 'form-control']),
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
                'urlCreator' => function ($action, PlayerInventory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
