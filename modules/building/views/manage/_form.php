<?php

use app\models\BuildingCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Building $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="building-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'width')->input('number') ?>

    <?= $form->field($model, 'length')->input('number') ?>

    <?= $form->field($model, 'building_category_id')->dropDownList(
        ArrayHelper::map(BuildingCategory::find()->all(), 'id', 'name'),
        ['prompt' => 'Select a Category']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
