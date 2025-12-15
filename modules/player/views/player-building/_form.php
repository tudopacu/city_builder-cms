<?php

use app\models\Building;
use app\models\Map;
use app\models\Player;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PlayerBuilding $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="player-building-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'player_id')->dropDownList(
        ArrayHelper::map(Player::find()->all(), 'id', 'username'),
        ['prompt' => 'Select a Player']
    ) ?>

    <?= $form->field($model, 'map_id')->dropDownList(
        ArrayHelper::map(Map::find()->all(), 'id', 'name'),
        ['prompt' => 'Select a Map']
    ) ?>

    <?=$form->field($model, 'building_id')->dropDownList(
        ArrayHelper::map(Building::find()->all(), 'id', 'name'),
        [
            'prompt' => 'Select a Building',
            'id' => 'building-id',
            'onchange' => '
            $.get("' . Url::to(['/building/building-level/get-levels']) . '", { buildingId: $(this).val() })
                .done(function(data) {
                    let $level = $("#building-level-id");
                    $level.empty();
                    $level.append("<option value=\"\">Select a Building Level</option>");

                    $.each(data, function(id, text) {
                        $level.append(new Option(text, id));
                    });
                });
        ',
        ]
    ); ?>

    <?= $form->field($model, 'building_level_id')->dropDownList(
        [],
        [
            'prompt' => 'Select a Building Level',
            'id' => 'building-level-id',
        ]
    ); ?>

    <?= $form->field($model, 'x')->input('number') ?>

    <?= $form->field($model, 'y')->input('number') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
