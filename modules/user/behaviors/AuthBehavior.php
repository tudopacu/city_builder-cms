<?php

namespace app\modules\user\behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;
use Yii;

class AuthBehavior extends Behavior
{
    public $authKeyAttribute = 'auth_key';
    public $accessTokenAttribute = 'access_token';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'generateKeys',
        ];
    }

    public function generateKeys($event)
    {
        if ($this->authKeyAttribute && !$this->owner->{$this->authKeyAttribute}) {
            $this->owner->{$this->authKeyAttribute} = Yii::$app->security->generateRandomString();
        }

        if ($this->accessTokenAttribute && !$this->owner->{$this->accessTokenAttribute}) {
            $this->owner->{$this->accessTokenAttribute} = Yii::$app->security->generateRandomString();
        }
    }
}