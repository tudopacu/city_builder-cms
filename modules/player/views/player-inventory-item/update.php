<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlayerInventoryItem $model */

$this->title = 'Update Player Inventory Item: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Player Inventory Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="player-inventory-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
