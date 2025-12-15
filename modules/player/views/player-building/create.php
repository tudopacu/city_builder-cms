<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlayerBuilding $model */

$this->title = 'Create Player Building';
$this->params['breadcrumbs'][] = ['label' => 'Player Buildings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-building-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
