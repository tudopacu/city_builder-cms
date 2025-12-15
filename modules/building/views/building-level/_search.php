<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BuildingLevelSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="building-level-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'building_id') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'build_time_seconds') ?>

    <?= $form->field($model, 'image_url') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
