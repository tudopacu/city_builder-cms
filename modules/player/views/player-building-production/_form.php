<?php

use app\models\Item;
use app\models\PlayerBuilding;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PlayerBuildingProduction $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="player-building-production-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'player_building_id')->dropDownList(
        ArrayHelper::map(
            PlayerBuilding::find()->joinWith('building')->orderBy('id')->all(),
            'id',
            function($model) {
                return $model->building ? $model->building->name . ' (ID: ' . $model->id . ')' : 'Building #' . $model->id;
            }
        ),
        ['prompt' => 'Select Player Building']
    ) ?>

    <?= $form->field($model, 'item_id')->dropDownList(
        ArrayHelper::map(Item::find()->orderBy('name')->all(), 'id', 'name'),
        ['prompt' => 'Select Item']
    ) ?>

    <?= $form->field($model, 'end_time')->textInput(['type' => 'datetime-local']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
