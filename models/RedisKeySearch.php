<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * RedisKeySearch is the model behind the search/filter form for Redis keys.
 */
class RedisKeySearch extends RedisKey
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'type'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates a data provider with optional search filters applied.
     *
     * @param array       $params
     * @param string|null $formName
     * @return ArrayDataProvider
     */
    public function search($params, $formName = null)
    {
        $this->load($params, $formName);

        if (!$this->validate()) {
            return new ArrayDataProvider(['allModels' => [], 'key' => 'key']);
        }

        $redis = Yii::$app->redis;

        // Use the key attribute as a Redis KEYS glob pattern; default to * (all keys)
        $pattern = !empty($this->key) ? $this->key : '*';
        $keys    = $redis->keys($pattern);
        sort($keys);

        $models = [];
        foreach ($keys as $redisKey) {
            $type = $redis->type($redisKey);

            // Filter by type when provided
            if (!empty($this->type) && $type !== $this->type) {
                continue;
            }

            $model              = new RedisKey();
            $model->isNewRecord = false;
            $model->key         = $redisKey;
            $model->type        = $type;
            $ttl                = $redis->ttl($redisKey);
            $model->ttl         = $ttl > 0 ? $ttl : 0;

            $models[] = $model;
        }

        return new ArrayDataProvider([
            'allModels'  => $models,
            'key'        => 'key',
            'pagination' => ['pageSize' => 20],
            'sort'       => [
                'attributes' => ['key', 'type', 'ttl'],
            ],
        ]);
    }
}
