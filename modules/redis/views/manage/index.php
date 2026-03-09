<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $items */
/** @var string $pattern */

$this->title = 'Redis Keys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redis-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex gap-2 mb-3">
        <?= Html::a('Create Key', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Purge All Keys', ['purge'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete ALL Redis keys? This action cannot be undone.',
                'method'  => 'post',
            ],
        ]) ?>
    </div>

    <form method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="pattern" class="form-control" placeholder="Key pattern (e.g. * or user:*)"
                   value="<?= Html::encode($pattern) ?>">
            <button class="btn btn-outline-secondary" type="submit">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Key</th>
                    <th>Type</th>
                    <th>TTL (s)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($items)): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">No keys found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= Html::encode($item['key']) ?></td>
                    <td><span class="badge bg-secondary"><?= Html::encode($item['type']) ?></span></td>
                    <td><?= $item['ttl'] < 0 ? '<span class="text-muted">∞</span>' : Html::encode($item['ttl']) ?></td>
                    <td>
                        <?= Html::a('View', ['view', 'key' => $item['key']], ['class' => 'btn btn-sm btn-primary']) ?>
                        <?= Html::a('Update', ['update', 'key' => $item['key']], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= Html::a('Delete', ['delete', 'key' => $item['key']], [
                            'class' => 'btn btn-sm btn-danger',
                            'data'  => [
                                'confirm' => 'Are you sure you want to delete key "' . Html::encode($item['key']) . '"?',
                                'method'  => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
