<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingConstructionCost $model */

$this->title = 'Create Building Construction Cost';
$this->params['breadcrumbs'][] = ['label' => 'Building Construction Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-construction-cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
