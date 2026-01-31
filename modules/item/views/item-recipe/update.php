<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ItemRecipe $model */

$this->title = 'Update Item Recipe: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Item Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Recipe #' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-recipe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
