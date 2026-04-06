<?php

use app\models\Building;
use app\models\Item;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BuildingWorker $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="building-worker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'building_id')->dropDownList(
        ArrayHelper::map(Building::find()->orderBy('name')->all(), 'id', 'name'),
        ['prompt' => 'Select Building']
    ) ?>

    <?= $form->field($model, 'item_id')->dropDownList(
        ArrayHelper::map(Item::find()->orderBy('name')->all(), 'id', 'name'),
        ['prompt' => 'Select Item']
    ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'range')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
