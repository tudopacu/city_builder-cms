<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Map $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="map-form">

        <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false, // or true if you want AJAX checks
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->input('number') ?>

    <?= $form->field($model, 'length')->input('number') ?>

    <?= $form->field($model, 'tile_x')->input('number', ['min' => 0, 'max' => 65535, 'step' => 1]) ?>

    <?= $form->field($model, 'tile_y')->input('number', ['min' => 0, 'max' => 65535, 'step' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
