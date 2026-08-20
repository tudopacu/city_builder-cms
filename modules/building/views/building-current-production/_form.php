<?php

use app\models\BuildingCurrentProduction;
use app\models\BuildingProduction;
use app\models\Player;
use app\models\PlayerBuilding;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BuildingCurrentProduction $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="building-current-production-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'player_id')->dropDownList(
        ArrayHelper::map(Player::find()->orderBy('id')->all(), 'id', 'username'),
        ['prompt' => 'Select Player']
    ) ?>

    <?= $form->field($model, 'player_building_id')->dropDownList(
        ArrayHelper::map(
            PlayerBuilding::find()->joinWith('building')->orderBy('id')->all(),
            'id',
            function($m) {
                return $m->building ? $m->building->name . ' (ID: ' . $m->id . ')' : 'Building #' . $m->id;
            }
        ),
        ['prompt' => 'Select Player Building']
    ) ?>

    <?= $form->field($model, 'building_production_id')->dropDownList(
        ArrayHelper::map(
            BuildingProduction::find()->joinWith(['building', 'item'])->orderBy('building_productions.id')->all(),
            'id',
            function($m) {
                $building = $m->building ? $m->building->name : '?';
                $item     = $m->item     ? $m->item->name     : '?';
                return $building . ' → ' . $item . ' (ID: ' . $m->id . ')';
            }
        ),
        ['prompt' => 'Select Building Production']
    ) ?>

    <?= $form->field($model, 'end_time')->textInput(['type' => 'datetime-local']) ?>

    <?= $form->field($model, 'status')->dropDownList(
        BuildingCurrentProduction::statusOptions(),
        ['prompt' => 'Select Status']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
