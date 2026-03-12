<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Intersection $model */

$this->title = 'Create Intersection';
$this->params['breadcrumbs'][] = ['label' => 'Intersections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intersection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
