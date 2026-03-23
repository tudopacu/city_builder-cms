<?php

use app\models\Invoice;
use app\models\Player;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Invoice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'player_id')->dropDownList(
        ArrayHelper::map(Player::find()->all(), 'id', 'username'),
        ['prompt' => 'Select Player']
    ) ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Invoice::getStatuses()) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'smartbill_invoice_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smartbill_series')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
