<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Item $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        'resource' => 'Resource',
        'building_material' => 'Building Material',
        'consumable' => 'Consumable',
        'quest' => 'Quest',
        'decoration' => 'Decoration',
    ], ['prompt' => 'Select Type']) ?>

    <?= $form->field($model, 'icon_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'is_tradeable')->checkbox() ?>

    <?= $form->field($model, 'item_recipe_id')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
