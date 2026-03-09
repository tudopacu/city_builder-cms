<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\RedisKey $model */

$this->title = $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Redis Keys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="redis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'key' => $model->key], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'key' => $model->key], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'key',
            'type',
            [
                'attribute' => 'ttl',
                'label'     => 'TTL',
                'value'     => $model->ttl > 0 ? $model->ttl . ' seconds' : 'No expiry (∞)',
            ],
            [
                'attribute' => 'value',
                'format'    => 'ntext',
            ],
        ],
    ]) ?>

</div>
