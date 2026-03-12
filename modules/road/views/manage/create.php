<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RoadType $model */

$this->title = 'Create Road Type';
$this->params['breadcrumbs'][] = ['label' => 'Road Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="road-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
