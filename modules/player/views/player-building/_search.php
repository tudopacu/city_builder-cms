<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PlayerBuildingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="player-building-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'player_id') ?>

    <?= $form->field($model, 'building_id') ?>

    <?= $form->field($model, 'map_id') ?>

    <?= $form->field($model, 'building_level_id') ?>

    <?php // echo $form->field($model, 'x') ?>

    <?php // echo $form->field($model, 'y') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
