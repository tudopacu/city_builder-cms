<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $key */
/** @var string $type */
/** @var int $ttl */
/** @var mixed $value */

$this->title = 'Redis Key: ' . $key;
$this->params['breadcrumbs'][] = ['label' => 'Redis Keys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $key;
\yii\web\YiiAsset::register($this);
?>
<div class="redis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'key' => $key], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'key' => $key], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this key?',
                'method'  => 'post',
            ],
        ]) ?>
        <?= Html::a('Back to List', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th style="width: 150px;">Key</th>
                <td><code><?= Html::encode($key) ?></code></td>
            </tr>
            <tr>
                <th>Type</th>
                <td><span class="badge bg-secondary"><?= Html::encode($type) ?></span></td>
            </tr>
            <tr>
                <th>TTL</th>
                <td>
                    <?php if ($ttl < 0): ?>
                        <span class="text-muted">No expiry (∞)</span>
                    <?php else: ?>
                        <?= Html::encode($ttl) ?> seconds
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Value</th>
                <td>
                    <?php if (is_array($value)): ?>
                        <pre class="mb-0"><?= Html::encode(json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) ?></pre>
                    <?php else: ?>
                        <pre class="mb-0"><?= Html::encode($value) ?></pre>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>

</div>
