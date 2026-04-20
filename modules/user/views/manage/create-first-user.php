<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Create First User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create-first-user">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>No users exist yet. Create the first administrator account below.</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'enableClientValidation' => true,
                'enableAjaxValidation' => false,
            ]); ?>

            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Create User', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
