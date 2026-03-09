<?php

namespace app\modules\redis\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageController implements CRUD actions for Redis keys.
 */
class ManageController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'purge'  => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Returns the Redis component.
     *
     * @return \yii\redis\Connection
     */
    protected function getRedis()
    {
        return Yii::$app->redis;
    }

    /**
     * Lists all Redis keys.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pattern = Yii::$app->request->get('pattern', '*');
        $redis = $this->getRedis();

        $keys = $redis->keys($pattern);
        sort($keys);

        $items = [];
        foreach ($keys as $key) {
            $type = $redis->type($key);
            $ttl  = $redis->ttl($key);
            $items[] = [
                'key'  => $key,
                'type' => $this->resolveTypeName($type),
                'ttl'  => $ttl,
            ];
        }

        return $this->render('index', [
            'items'   => $items,
            'pattern' => $pattern,
        ]);
    }

    /**
     * Displays a single Redis key.
     *
     * @param string $key
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($key)
    {
        $redis = $this->getRedis();

        if (!$redis->exists($key)) {
            throw new NotFoundHttpException('The requested key does not exist.');
        }

        $type  = $redis->type($key);
        $ttl   = $redis->ttl($key);
        $value = $this->fetchValue($redis, $key, $type);

        return $this->render('view', [
            'key'   => $key,
            'type'  => $this->resolveTypeName($type),
            'ttl'   => $ttl,
            'value' => $value,
        ]);
    }

    /**
     * Creates a new Redis key.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {
            $post  = Yii::$app->request->post();
            $key   = trim($post['key'] ?? '');
            $value = $post['value'] ?? '';
            $ttl   = (int)($post['ttl'] ?? 0);

            $errors = $this->validateKeyValue($key, $value);

            if (empty($errors)) {
                $redis = $this->getRedis();

                if ($redis->exists($key)) {
                    $errors['key'] = 'Key already exists. Use Update to modify it.';
                } else {
                    $redis->set($key, $value);
                    if ($ttl > 0) {
                        $redis->expire($key, $ttl);
                    }
                    Yii::$app->session->setFlash('success', "Key \"{$key}\" created successfully.");
                    return $this->redirect(['view', 'key' => $key]);
                }
            }

            return $this->render('create', [
                'key'    => $post['key'] ?? '',
                'value'  => $value,
                'ttl'    => $ttl,
                'errors' => $errors,
            ]);
        }

        return $this->render('create', [
            'key'    => '',
            'value'  => '',
            'ttl'    => 0,
            'errors' => [],
        ]);
    }

    /**
     * Updates an existing Redis key value.
     *
     * @param string $key
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($key)
    {
        $redis = $this->getRedis();

        if (!$redis->exists($key)) {
            throw new NotFoundHttpException('The requested key does not exist.');
        }

        $type  = $redis->type($key);
        $ttl   = $redis->ttl($key);
        $value = $this->fetchValue($redis, $key, $type);

        if (Yii::$app->request->isPost) {
            $post     = Yii::$app->request->post();
            $newValue = $post['value'] ?? '';
            $newTtl   = (int)($post['ttl'] ?? 0);

            $errors = $this->validateKeyValue($key, $newValue);

            if (empty($errors)) {
                $redis->set($key, $newValue);
                if ($newTtl > 0) {
                    $redis->expire($key, $newTtl);
                } else {
                    $redis->persist($key);
                }
                Yii::$app->session->setFlash('success', "Key \"{$key}\" updated successfully.");
                return $this->redirect(['view', 'key' => $key]);
            }

            $value = $newValue;
            $ttl   = $newTtl;
        }

        return $this->render('update', [
            'key'    => $key,
            'value'  => is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value,
            'ttl'    => $ttl < 0 ? 0 : $ttl,
            'errors' => [],
        ]);
    }

    /**
     * Deletes a Redis key.
     *
     * @param string $key
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($key)
    {
        $redis = $this->getRedis();

        if (!$redis->exists($key)) {
            throw new NotFoundHttpException('The requested key does not exist.');
        }

        $redis->del($key);
        Yii::$app->session->setFlash('success', "Key \"{$key}\" deleted successfully.");

        return $this->redirect(['index']);
    }

    /**
     * Purges (flushes) all keys from the current Redis database.
     *
     * @return \yii\web\Response
     */
    public function actionPurge()
    {
        $this->getRedis()->flushdb();
        Yii::$app->session->setFlash('success', 'All Redis keys have been purged.');

        return $this->redirect(['index']);
    }

    /**
     * Fetches the value of a key based on its type.
     *
     * @param \yii\redis\Connection $redis
     * @param string $key
     * @param int $type
     * @return mixed
     */
    protected function fetchValue($redis, $key, $type)
    {
        switch ($type) {
            case 1: // string
                return $redis->get($key);
            case 2: // list
                return $redis->lrange($key, 0, -1);
            case 3: // set
                return $redis->smembers($key);
            case 4: // zset
                return $redis->zrange($key, 0, -1, 'WITHSCORES');
            case 5: // hash
                return $redis->hgetall($key);
            default:
                return null;
        }
    }

    /**
     * Resolves a Redis type integer to a human-readable name.
     *
     * @param int $type
     * @return string
     */
    protected function resolveTypeName($type)
    {
        $types = [
            0 => 'none',
            1 => 'string',
            2 => 'list',
            3 => 'set',
            4 => 'zset',
            5 => 'hash',
        ];
        return $types[$type] ?? 'unknown';
    }

    /**
     * Validates key and value inputs.
     *
     * @param string $key
     * @param string $value
     * @return array errors
     */
    protected function validateKeyValue($key, $value)
    {
        $errors = [];
        if (empty($key)) {
            $errors['key'] = 'Key cannot be empty.';
        }
        if ($value === '') {
            $errors['value'] = 'Value cannot be empty.';
        }
        return $errors;
    }
}
