<?php

use app\models\Item;
use app\models\ItemRecipe;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ItemRecipeInput $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-recipe-input-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'recipe_id')->dropDownList(
        ArrayHelper::map(
            ItemRecipe::find()->with('outputItem')->all(), 
            'id', 
            function($recipe) {
                return 'Recipe #' . $recipe->id . ' (Item: ' . ($recipe->item ? $recipe->item->name : 'N/A') . ')';
            }
        ),
        ['prompt' => 'Select Recipe']
    ) ?>

    <?= $form->field($model, 'input_item_id')->dropDownList(
        ArrayHelper::map(Item::find()->orderBy('name')->all(), 'id', 'name'),
        ['prompt' => 'Select Input Item']
    ) ?>

    <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
