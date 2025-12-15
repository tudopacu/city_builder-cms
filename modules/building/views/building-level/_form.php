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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
