<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var string $key */
/** @var string $value */
/** @var int $ttl */
/** @var array $errors */
/** @var bool $isUpdate */
?>

<div class="redis-form">

    <?php $form = ActiveForm::begin(['id' => 'redis-form']); ?>

    <div class="mb-3">
        <label class="form-label" for="redis-key">Key <span class="text-danger">*</span></label>
        <input type="text"
               id="redis-key"
               name="key"
               class="form-control<?= !empty($errors['key']) ? ' is-invalid' : '' ?>"
               value="<?= Html::encode($key) ?>"
               <?= $isUpdate ? 'readonly' : '' ?>
               required>
        <?php if (!empty($errors['key'])): ?>
            <div class="invalid-feedback"><?= Html::encode($errors['key']) ?></div>
        <?php endif; ?>
        <?php if ($isUpdate): ?>
            <div class="form-text text-muted">Key name cannot be changed. Delete and recreate to rename.</div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label" for="redis-value">Value <span class="text-danger">*</span></label>
        <textarea id="redis-value"
                  name="value"
                  rows="6"
                  class="form-control<?= !empty($errors['value']) ? ' is-invalid' : '' ?>"
                  required><?= Html::encode($value) ?></textarea>
        <?php if (!empty($errors['value'])): ?>
            <div class="invalid-feedback"><?= Html::encode($errors['value']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label" for="redis-ttl">TTL (seconds)</label>
        <input type="number"
               id="redis-ttl"
               name="ttl"
               class="form-control"
               value="<?= (int)$ttl ?>"
               min="0">
        <div class="form-text text-muted">Set to 0 for no expiry.</div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
