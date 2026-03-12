<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Intersection $model */

$this->title = 'Update Intersection #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Intersections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Intersection #' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="intersection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
