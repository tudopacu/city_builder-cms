<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "players".
 *
 * @property int $id
 * @property string $username
 * @property string|null $email
 * @property string $password
 * @property string|null $created_at
 * @property string|null $last_login_at
 * @property string $status
 */
class Player extends CoreModel
{

    /**
     * ENUM field values
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_BANNED = 'banned';
    const STATUS_SUSPENDED = 'suspended';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'players';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'last_login_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'active'],
            [['username', 'password'], 'required'],
            [['created_at', 'last_login_at'], 'safe'],
            [['status'], 'string'],
            ['email', 'email'],
            [['username'], 'string', 'max' => 50],
            [['email', 'password'], 'string', 'max' => 255],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'created_at' => 'Created At',
            'last_login_at' => 'Last Login At',
            'status' => 'Status',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isAttributeChanged('password')) {
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     * @return PlayerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlayerQuery(get_called_class());
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_ACTIVE => 'active',
            self::STATUS_BANNED => 'banned',
            self::STATUS_SUSPENDED => 'suspended',
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function setStatusToActive()
    {
        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * @return bool
     */
    public function isStatusBanned()
    {
        return $this->status === self::STATUS_BANNED;
    }

    public function setStatusToBanned()
    {
        $this->status = self::STATUS_BANNED;
    }

    /**
     * @return bool
     */
    public function isStatusSuspended()
    {
        return $this->status === self::STATUS_SUSPENDED;
    }

    public function setStatusToSuspended()
    {
        $this->status = self::STATUS_SUSPENDED;
    }
}
