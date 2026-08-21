<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\PlayerInventoryItem $model */

$this->title = 'Player Inventory Item #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Player Inventory Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="player-inventory-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'player_inventory_id',
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
            'quantity',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
