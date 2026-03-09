<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RedisKey represents a single key-value entry in Redis.
 *
 * @property string $key   Redis key name
 * @property string $value String value stored at this key
 * @property int    $ttl   Time-to-live in seconds (0 = no expiry)
 * @property string $type  Redis data type (string, list, set, zset, hash, none)
 */
class RedisKey extends Model
{
    /** @var string */
    public $key;

    /** @var string */
    public $value;

    /** @var int */
    public $ttl = 0;

    /** @var string */
    public $type = 'string';

    /**
     * Whether this key does not yet exist in Redis.
     *
     * @var bool
     */
    public $isNewRecord = true;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['key', 'value'], 'string'],
            [['key'], 'validateKeyUnique'],
            [['ttl'], 'integer', 'min' => 0],
            [['ttl'], 'default', 'value' => 0],
            [['type'], 'safe'],
        ];
    }

    /**
     * Validates that the key does not already exist in Redis (create only).
     *
     * @param string $attribute
     * @param array  $params
     */
    public function validateKeyUnique($attribute, $params)
    {
        if ($this->isNewRecord && Yii::$app->redis->exists($this->$attribute)) {
            $this->addError($attribute, 'Key already exists. Use Update to modify it.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'key'   => 'Key',
            'value' => 'Value',
            'ttl'   => 'TTL (seconds)',
            'type'  => 'Type',
        ];
    }

    /**
     * Loads a Redis key into a RedisKey model instance.
     *
     * @param string $key
     * @return static|null
     */
    public static function findOne($key)
    {
        $redis = Yii::$app->redis;

        if (!$redis->exists($key)) {
            return null;
        }

        $model              = new static();
        $model->isNewRecord = false;
        $model->key         = $key;
        $type               = $redis->type($key);
        $model->type        = $type;
        $ttl                = $redis->ttl($key);
        $model->ttl         = $ttl > 0 ? $ttl : 0;
        $value              = static::fetchValue($redis, $key, $type);
        $model->value       = is_array($value)
            ? json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            : (string)$value;

        return $model;
    }

    /**
     * Persists the model to Redis.
     *
     * @return bool
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $redis = Yii::$app->redis;
        $redis->set($this->key, $this->value);

        if ((int)$this->ttl > 0) {
            $redis->expire($this->key, (int)$this->ttl);
        } else {
            $redis->persist($this->key);
        }

        $this->isNewRecord = false;

        return true;
    }

    /**
     * Deletes this key from Redis.
     *
     * @return int number of keys removed
     */
    public function delete()
    {
        return Yii::$app->redis->del($this->key);
    }

    /**
     * Retrieves the stored value for a key based on its Redis data type.
     *
     * @param \yii\redis\Connection $redis
     * @param string                $key
     * @param string                $type
     * @return mixed
     */
    protected static function fetchValue($redis, $key, $type)
    {
        switch ($type) {
            case 'string': return $redis->get($key);
            case 'list':   return $redis->lrange($key, 0, -1);
            case 'set':    return $redis->smembers($key);
            case 'zset':   return $redis->zrange($key, 0, -1, 'WITHSCORES');
            case 'hash':   return $redis->hgetall($key);
            default:       return null;
        }
    }
}
