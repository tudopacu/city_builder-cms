<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingCategory $model */

$this->title = 'Create Building Category';
$this->params['breadcrumbs'][] = ['label' => 'Building Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
