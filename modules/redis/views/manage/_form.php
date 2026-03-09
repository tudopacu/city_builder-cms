<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RedisKey $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="redis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['readonly' => !$model->isNewRecord]) ?>

    <?php if (!$model->isNewRecord): ?>
        <div class="form-text text-muted mb-3">Key name cannot be changed. Delete and recreate to rename.</div>
    <?php endif; ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ttl')->textInput(['type' => 'number', 'min' => 0])->hint('Set to 0 for no expiry.') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
