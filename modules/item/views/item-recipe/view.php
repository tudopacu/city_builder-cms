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
                'format' => 'raw',
                'value' => function ($model) {
                    if (!$model->item) return $model->item_id;
                    $item = $model->item;
                    $name = Html::a(Html::encode($item->name), ['/item/manage/view', 'id' => $item->id]);
                    if (!$item->icon_url) return $name;
                    $fullUrl = IMAGE_BASE_URL . $item->icon_url;
                    return $name . ' ' . Html::a(Html::img($fullUrl, ['style' => 'max-width:50px;max-height:50px;']), $fullUrl);
                },
            ],
            'production_time_seconds',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <h3>Recipe Inputs</h3>
    <?php if ($model->itemRecipeInputs): ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => array_map(function ($input) {
                if (!$input->inputItem) {
                    return ['label' => 'Item #' . $input->input_item_id, 'value' => $input->quantity];
                }
                $item = $input->inputItem;
                $label = Html::encode($item->name);
                if ($item->icon_url) {
                    $fullUrl = IMAGE_BASE_URL . $item->icon_url;
                    $label .= ' ' . Html::a(Html::img($fullUrl, ['style' => 'max-width:30px;max-height:30px;']), $fullUrl);
                }
                return ['label' => $label, 'value' => $input->quantity, 'encodeLabel' => false];
            }, $model->itemRecipeInputs),
        ]) ?>
    <?php else: ?>
        <p class="text-muted">No inputs defined for this recipe.</p>
    <?php endif; ?>

</div>
