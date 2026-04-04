<?php

use app\models\Intersection;
use app\models\Map;
use app\models\Player;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\IntersectionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Intersections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intersection-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Intersection', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'map_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->map
                        ? Html::a($model->map->name, ['/map/manage/view', 'id' => $model->map_id])
                        : $model->map_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[map_id]',
                    $searchModel->map_id,
                    ArrayHelper::map(Map::find()->orderBy('name')->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'All']
                ),
            ],
            [
                'attribute' => 'player_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->player
                        ? Html::a($model->player->username, ['/player/manage/view', 'id' => $model->player_id])
                        : $model->player_id;
                },
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[player_id]',
                    $searchModel->player_id,
                    ArrayHelper::map(Player::find()->orderBy('username')->all(), 'id', 'username'),
                    ['class' => 'form-control', 'prompt' => 'All']
                ),
            ],
            [
                'attribute' => 'x',
                'filter' => Html::input('number', $searchModel->formName() . '[x]', $searchModel->x, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'y',
                'filter' => Html::input('number', $searchModel->formName() . '[y]', $searchModel->y, ['class' => 'form-control']),
            ],
            [
                'attribute' => 'type',
                'filter' => Html::dropDownList(
                    $searchModel->formName() . '[type]',
                    $searchModel->type,
                    Intersection::typeList(),
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
