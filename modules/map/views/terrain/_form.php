<?php

use app\models\Map;
use app\models\Tile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Terrain $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="terrain-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false, // or true if you want AJAX checks
    ]); ?>

    <?= $form->field($model, 'map_id')->dropDownList(
        ArrayHelper::map(Map::find()->all(), 'id', 'name'),
        ['prompt' => 'Select a Map']
    ) ?>

    <?= $form->field($model, 'tile_id')->dropDownList(
        ArrayHelper::map(Tile::find()->all(), 'id', 'type'),
        ['prompt' => 'Select a Tile']
    ) ?>

    <?= $form->field($model, 'x')->input('number') ?>

    <?= $form->field($model, 'y')->input('number') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
