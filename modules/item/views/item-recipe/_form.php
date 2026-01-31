<?php

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ItemRecipe $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-recipe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_id')->dropDownList(
        ArrayHelper::map(Item::find()->orderBy('name')->all(), 'id', 'name'),
        ['prompt' => 'Select Output Item']
    ) ?>

    <?= $form->field($model, 'production_time_seconds')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
