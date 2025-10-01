<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tile $model */

$this->title = 'Create Tile';
$this->params['breadcrumbs'][] = ['label' => 'Tiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
