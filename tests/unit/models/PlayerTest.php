<?php

namespace tests\unit\models;

use app\models\Player;

class PlayerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testTableName()
    {
        verify(Player::tableName())->equals('players');
    }

    public function testStatusConstants()
    {
        verify(Player::STATUS_ACTIVE)->equals('active');
        verify(Player::STATUS_BANNED)->equals('banned');
        verify(Player::STATUS_SUSPENDED)->equals('suspended');
    }

    public function testPlayerStatusArray()
    {
        $expectedStatuses = [
            'active' => 'Active',
            'banned' => 'Banned',
            'suspended' => 'Suspended',
        ];
        
        verify(Player::PLAYER_STATUS)->equals($expectedStatuses);
    }

    public function testOptsStatus()
    {
        $expectedStatuses = [
            'active' => 'active',
            'banned' => 'banned',
            'suspended' => 'suspended',
        ];
        
        verify(Player::optsStatus())->equals($expectedStatuses);
    }

    public function testValidationRules()
    {
        $player = new Player();
        
        // Test required fields
        verify($player->validate())->false();
        verify($player->hasErrors('username'))->true();
        verify($player->hasErrors('password'))->true();
    }

    public function testUsernameRequired()
    {
        $player = new Player();
        $player->password = 'testpassword';
        
        verify($player->validate())->false();
        verify($player->hasErrors('username'))->true();
    }

    public function testPasswordRequired()
    {
        $player = new Player();
        $player->username = 'testuser';
        
        verify($player->validate())->false();
        verify($player->hasErrors('password'))->true();
    }

    public function testUsernameMaxLength()
    {
        $player = new Player();
        $player->username = str_repeat('a', 51); // 51 characters, exceeds max of 50
        $player->password = 'testpassword';
        
        verify($player->validate())->false();
        verify($player->hasErrors('username'))->true();
    }

    public function testPasswordMaxLength()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = str_repeat('a', 256); // 256 characters, exceeds max of 255
        
        verify($player->validate())->false();
        verify($player->hasErrors('password'))->true();
    }

    public function testEmailMaxLength()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = 'testpassword';
        $player->email = str_repeat('a', 256); // 256 characters, exceeds max of 255
        
        verify($player->validate())->false();
        verify($player->hasErrors('email'))->true();
    }

    public function testEmailValidation()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = 'testpassword';
        $player->email = 'invalid-email';
        
        verify($player->validate())->false();
        verify($player->hasErrors('email'))->true();
    }

    public function testValidEmail()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = 'testpassword';
        $player->email = 'test@example.com';
        
        verify($player->validate(['username', 'password', 'email']))->true();
        verify($player->hasErrors('email'))->false();
    }

    public function testDefaultStatusIsActive()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = 'testpassword';
        
        // Default value should be set
        verify($player->status)->equals('active');
    }

    public function testStatusInRange()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = 'testpassword';
        $player->status = 'invalid-status';
        
        verify($player->validate())->false();
        verify($player->hasErrors('status'))->true();
    }

    public function testValidActiveStatus()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = 'testpassword';
        $player->status = 'active';
        
        verify($player->validate(['username', 'password', 'status']))->true();
        verify($player->hasErrors('status'))->false();
    }

    public function testValidBannedStatus()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = 'testpassword';
        $player->status = 'banned';
        
        verify($player->validate(['username', 'password', 'status']))->true();
        verify($player->hasErrors('status'))->false();
    }

    public function testValidSuspendedStatus()
    {
        $player = new Player();
        $player->username = 'testuser';
        $player->password = 'testpassword';
        $player->status = 'suspended';
        
        verify($player->validate(['username', 'password', 'status']))->true();
        verify($player->hasErrors('status'))->false();
    }

    public function testIsStatusActive()
    {
        $player = new Player();
        $player->status = 'active';
        
        verify($player->isStatusActive())->true();
        verify($player->isStatusBanned())->false();
        verify($player->isStatusSuspended())->false();
    }

    public function testIsStatusBanned()
    {
        $player = new Player();
        $player->status = 'banned';
        
        verify($player->isStatusActive())->false();
        verify($player->isStatusBanned())->true();
        verify($player->isStatusSuspended())->false();
    }

    public function testIsStatusSuspended()
    {
        $player = new Player();
        $player->status = 'suspended';
        
        verify($player->isStatusActive())->false();
        verify($player->isStatusBanned())->false();
        verify($player->isStatusSuspended())->true();
    }

    public function testSetStatusToActive()
    {
        $player = new Player();
        $player->status = 'banned';
        
        $player->setStatusToActive();
        verify($player->status)->equals('active');
        verify($player->isStatusActive())->true();
    }

    public function testSetStatusToBanned()
    {
        $player = new Player();
        $player->status = 'active';
        
        $player->setStatusToBanned();
        verify($player->status)->equals('banned');
        verify($player->isStatusBanned())->true();
    }

    public function testSetStatusToSuspended()
    {
        $player = new Player();
        $player->status = 'active';
        
        $player->setStatusToSuspended();
        verify($player->status)->equals('suspended');
        verify($player->isStatusSuspended())->true();
    }

    public function testDisplayStatus()
    {
        $player = new Player();
        
        $player->status = 'active';
        verify($player->displayStatus())->equals('active');
        
        $player->status = 'banned';
        verify($player->displayStatus())->equals('banned');
        
        $player->status = 'suspended';
        verify($player->displayStatus())->equals('suspended');
    }

    public function testAttributeLabels()
    {
        $player = new Player();
        $labels = $player->attributeLabels();
        
        verify($labels['id'])->equals('ID');
        verify($labels['username'])->equals('Username');
        verify($labels['email'])->equals('Email');
        verify($labels['password'])->equals('Password');
        verify($labels['created_at'])->equals('Created At');
        verify($labels['last_login_at'])->equals('Last Login At');
        verify($labels['status'])->equals('Status');
    }
}
