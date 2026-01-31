<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BuildingConstructionCost $model */

$this->title = 'Update Building Construction Cost: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Building Construction Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Cost #' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="building-construction-cost-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
