<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * BaseController provides shared functionality for all application controllers.
 */
class BaseController extends Controller
{
    /**
     * Deletes all Redis keys that start with the given prefix.
     *
     * @param string $prefix The key prefix to match (e.g. 'news', 'building', 'item')
     */
    protected function deleteRedisKeysByPrefix(string $prefix): void
    {
        $keys = Yii::$app->redis->keys($prefix . '*');
        if (!empty($keys)) {
            Yii::$app->redis->del(...$keys);
        }
    }
}
