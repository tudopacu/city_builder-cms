<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ItemRecipe $model */

$this->title = 'Create Item Recipe';
$this->params['breadcrumbs'][] = ['label' => 'Item Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-recipe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
