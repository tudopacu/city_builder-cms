<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingProduction $model */

$this->title = 'Create Building Production';
$this->params['breadcrumbs'][] = ['label' => 'Building Productions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-production-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
