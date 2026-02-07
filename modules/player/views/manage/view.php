<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Player $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="player-view">

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
            'username',
            'email:email',
            'created_at',
            'last_login_at',
            'status',
        ],
    ]) ?>

    <h3>Buildings</h3>
    <?php if ($model->playerBuildings): ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => array_map(function ($input) {
                return [
                    'label' => $input->building ? $input->building->name : 'Building #' . $input->id,
                    'value' => 'x: ' . $input->x . ', y: ' . $input->y . ' (Map: ' . ($input->map->name ?? 'N/A') . ')',
                ];
            }, $model->playerBuildings),
        ]) ?>
    <?php else: ?>
        <p class="text-muted">This player has no buildings.</p>
    <?php endif; ?>

</div>
