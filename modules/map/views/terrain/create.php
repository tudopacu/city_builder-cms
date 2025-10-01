<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Terrain $model */

$this->title = 'Create Terrain';
$this->params['breadcrumbs'][] = ['label' => 'Terrains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terrain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
