<?php

use app\models\Building;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PlayerInventory $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="player-inventory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'building_id')->dropDownList(
        ArrayHelper::map(
            Building::find()
                ->where(['building_category_id' => 3])
                ->orderBy('name')
                ->all(),
            'id',
            'name'
        ),
        ['prompt' => 'Select Storage Building']
    ) ?>

    <?= $form->field($model, 'capacity')->textInput(['type' => 'number', 'min' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
