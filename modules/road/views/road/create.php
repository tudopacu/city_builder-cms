<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Road $model */

$this->title = 'Create Road';
$this->params['breadcrumbs'][] = ['label' => 'Roads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="road-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
