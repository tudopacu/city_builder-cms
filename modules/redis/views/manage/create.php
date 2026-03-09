<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $key */
/** @var string $value */
/** @var int $ttl */
/** @var array $errors */

$this->title = 'Create Redis Key';
$this->params['breadcrumbs'][] = ['label' => 'Redis Keys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'key'      => $key,
        'value'    => $value,
        'ttl'      => $ttl,
        'errors'   => $errors,
        'isUpdate' => false,
    ]) ?>

</div>
