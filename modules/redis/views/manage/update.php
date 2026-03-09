<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RedisKey $model */

$this->title = 'Update Redis Key: ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Redis Keys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->key, 'url' => ['view', 'key' => $model->key]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="redis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
