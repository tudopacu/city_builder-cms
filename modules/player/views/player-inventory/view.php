<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\PlayerInventory $model */

$this->title = 'Player Inventory #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Player Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="player-inventory-view">

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
            [
                'attribute' => 'player_id',
                'value' => $model->player ? $model->player->username : $model->player_id,
            ],
            [
                'attribute' => 'player_building_id',
                'value' => function($m) {
                    if ($m->playerBuilding && $m->playerBuilding->building) {
                        return 'Building #' . $m->player_building_id . ' - ' . $m->playerBuilding->building->name;
                    }
                    return $m->player_building_id;
                },
            ],
            'capacity',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
