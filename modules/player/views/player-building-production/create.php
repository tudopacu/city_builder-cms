<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlayerBuildingProduction $model */

$this->title = 'Create Player Building Production';
$this->params['breadcrumbs'][] = ['label' => 'Player Building Productions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-building-production-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
