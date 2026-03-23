<?php

use app\models\Invoice;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Invoice $model */

$this->title = 'Invoice #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="invoice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this invoice?',
                'method'  => 'post',
            ],
        ]) ?>
        <?php if ($model->status === Invoice::STATUS_DRAFT): ?>
            <?= Html::a('Issue via Smartbill', ['issue', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data'  => [
                    'confirm' => 'Are you sure you want to issue this invoice via Smartbill?',
                    'method'  => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if ($model->status === Invoice::STATUS_ISSUED): ?>
            <?= Html::a('Cancel Invoice', ['cancel', 'id' => $model->id], [
                'class' => 'btn btn-secondary',
                'data'  => [
                    'confirm' => 'Are you sure you want to cancel this invoice?',
                    'method'  => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'player_id',
                'value'     => $model->player ? $model->player->username : $model->player_id,
            ],
            'amount',
            'currency',
            [
                'attribute' => 'status',
                'value'     => Invoice::getStatuses()[$model->status] ?? $model->status,
            ],
            'smartbill_invoice_number',
            'smartbill_series',
            'description',
            'issued_at',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
