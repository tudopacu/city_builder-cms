<?php

use app\models\Map;
use app\models\Player;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Intersection $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="intersection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'map_id')->dropDownList(
        ArrayHelper::map(Map::find()->orderBy('name')->all(), 'id', 'name'),
        ['prompt' => 'Select Map']
    ) ?>

    <?= $form->field($model, 'player_id')->dropDownList(
        ArrayHelper::map(Player::find()->orderBy('username')->all(), 'id', 'username'),
        ['prompt' => 'Select Player']
    ) ?>

    <?= $form->field($model, 'x')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'y')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
