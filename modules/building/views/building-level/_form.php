<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BuildingLevel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="building-level-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'building_id')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'build_time_seconds')->textInput() ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacity')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'population_capacity')
        ->textInput(['type' => 'number', 'min' => 0])
        ->hint('Set on housing buildings: how much population this building adds while it exists.') ?>

    <?= $form->field($model, 'population_cost')
        ->textInput(['type' => 'number', 'min' => 0])
        ->hint('Population this building uses while it exists. It cannot be built without enough free population.') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
