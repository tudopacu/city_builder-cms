<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ItemRecipeInput $model */

$this->title = 'Create Item Recipe Input';
$this->params['breadcrumbs'][] = ['label' => 'Item Recipe Inputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-recipe-input-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
