<?php

use app\models\PlayerBuilding;
use app\models\Player;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PlayerInventory $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="player-inventory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'player_id')->dropDownList(
        ArrayHelper::map(Player::find()->orderBy('username')->all(), 'id', 'username'),
        ['prompt' => 'Select Player']
    ) ?>

    <?= $form->field($model, 'player_building_id')->dropDownList(
        ArrayHelper::map(
            PlayerBuilding::find()
                ->joinWith('building')
                ->where(['buildings.building_category_id' => 3])
                ->orderBy('player_buildings.id')
                ->all(),
            'id',
            function($model) {
                return 'Building #' . $model->id . ' - ' . ($model->building ? $model->building->name : 'N/A') . ' (Player: ' . ($model->player ? $model->player->username : 'N/A') . ')';
            }
        ),
        ['prompt' => 'Select Player Building (Storage only)']
    ) ?>

    <?= $form->field($model, 'capacity')->textInput(['type' => 'number', 'min' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
