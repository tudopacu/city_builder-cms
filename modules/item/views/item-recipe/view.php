<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ItemRecipe $model */

$this->title = 'Item Recipe #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Item Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-recipe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item recipe?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add Input Item', ['item-recipe-input/create', 'recipe_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'item_id',
                'value' => $model->outputItem ? $model->outputItem->name : $model->item_id,
            ],
            'production_time_seconds',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <h3>Recipe Inputs</h3>
    <?php if ($model->itemRecipeInputs): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Input Item</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->itemRecipeInputs as $input): ?>
                    <tr>
                        <td><?= Html::encode($input->inputItem ? $input->inputItem->name : 'Item #' . $input->input_item_id) ?></td>
                        <td><?= Html::encode($input->quantity) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No inputs defined for this recipe.</p>
    <?php endif; ?>

</div>
