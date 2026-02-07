<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlayerInventory $model */

$this->title = 'Create Player Inventory';
$this->params['breadcrumbs'][] = ['label' => 'Player Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-inventory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
