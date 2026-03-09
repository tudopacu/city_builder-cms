<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RedisKey $model */

$this->title = 'Create Redis Key';
$this->params['breadcrumbs'][] = ['label' => 'Redis Keys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
