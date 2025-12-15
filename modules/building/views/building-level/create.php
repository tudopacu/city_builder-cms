<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingLevel $model */

$this->title = 'Create Building Level';
$this->params['breadcrumbs'][] = ['label' => 'Building Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
