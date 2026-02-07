<?php

use app\models\PlayerInventory;
use app\models\Item;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PlayerInventoryItem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="player-inventory-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'player_inventory_id')->dropDownList(
        ArrayHelper::map(
            PlayerInventory::find()->orderBy('id')->all(),
            'id',
            function($model) {
                return 'Inventory #' . $model->id . ' (' . ($model->building ? $model->building->name : 'N/A') . ')';
            }
        ),
        ['prompt' => 'Select Player Inventory']
    ) ?>

    <?= $form->field($model, 'item_id')->dropDownList(
        ArrayHelper::map(Item::find()->orderBy('name')->all(), 'id', 'name'),
        ['prompt' => 'Select Item']
    ) ?>

    <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 0]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
