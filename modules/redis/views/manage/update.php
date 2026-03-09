<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $key */
/** @var string $value */
/** @var int $ttl */
/** @var array $errors */

$this->title = 'Update Redis Key: ' . $key;
$this->params['breadcrumbs'][] = ['label' => 'Redis Keys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $key, 'url' => ['view', 'key' => $key]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="redis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'key'      => $key,
        'value'    => $value,
        'ttl'      => $ttl,
        'errors'   => $errors,
        'isUpdate' => true,
    ]) ?>

</div>
