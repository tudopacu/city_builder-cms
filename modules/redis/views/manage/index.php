<?php

use app\models\RedisKey;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\RedisKeySearch $searchModel */
/** @var yii\data\ArrayDataProvider $dataProvider */

$this->title = 'Redis Keys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redis-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Redis Key', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Purge All Keys', ['purge'], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete ALL Redis keys? This action cannot be undone.',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [
                'attribute' => 'key',
                'filter'    => Html::activeTextInput($searchModel, 'key', ['class' => 'form-control', 'placeholder' => 'e.g. user:*']),
            ],
            [
                'attribute' => 'type',
                'filter'    => Html::activeTextInput($searchModel, 'type', ['class' => 'form-control']),
                'value'     => function (RedisKey $model) {
                    return $model->type;
                },
            ],
            [
                'attribute' => 'ttl',
                'filter'    => false,
                'value'     => function (RedisKey $model) {
                    return $model->ttl > 0 ? $model->ttl . ' s' : '∞';
                },
            ],
            [
                'class'      => ActionColumn::className(),
                'urlCreator' => function ($action, RedisKey $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'key' => $model->key]);
                },
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
