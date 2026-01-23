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

    <?= $form->field($model, 'rarity')->dropDownList([
        'common' => 'Common',
        'uncommon' => 'Uncommon',
        'rare' => 'Rare',
        'epic' => 'Epic',
        'legendary' => 'Legendary',
    ], ['prompt' => 'Select Rarity']) ?>

    <?= $form->field($model, 'icon_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_stack')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'value')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'is_tradeable')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
