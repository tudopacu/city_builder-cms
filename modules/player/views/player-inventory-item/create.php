<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlayerInventoryItem $model */

$this->title = 'Create Player Inventory Item';
$this->params['breadcrumbs'][] = ['label' => 'Player Inventory Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-inventory-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
