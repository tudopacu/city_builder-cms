<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ItemRecipeInput $model */

$this->title = 'Item Recipe Input #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Item Recipe Inputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-recipe-input-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item recipe input?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Go to recipe', ['item-recipe/view', 'id' => $model->recipe_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'recipe_id',
                'value' => $model->recipe ? 'Recipe #' . $model->recipe->id . ' (Output: ' . ($model->recipe->outputItem ? $model->recipe->outputItem->name : 'N/A') . ')' : $model->recipe_id,
            ],
            [
                'attribute' => 'input_item_id',
                'value' => $model->inputItem ? $model->inputItem->name : $model->input_item_id,
            ],
            'quantity',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
