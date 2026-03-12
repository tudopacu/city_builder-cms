<?php

use app\models\Intersection;
use app\models\RoadType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Road $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="road-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_intersection_id')->dropDownList(
        ArrayHelper::map(Intersection::find()->orderBy('id')->all(), 'id', function ($m) { return 'Intersection #' . $m->id . ' (' . $m->x . ', ' . $m->y . ')'; }),
        ['prompt' => 'Select Start Intersection']
    ) ?>

    <?= $form->field($model, 'end_intersection_id')->dropDownList(
        ArrayHelper::map(Intersection::find()->orderBy('id')->all(), 'id', function ($m) { return 'Intersection #' . $m->id . ' (' . $m->x . ', ' . $m->y . ')'; }),
        ['prompt' => 'Select End Intersection']
    ) ?>

    <?= $form->field($model, 'road_type_id')->dropDownList(
        ArrayHelper::map(RoadType::find()->orderBy('type')->all(), 'id', 'type'),
        ['prompt' => 'Select Road Type']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
