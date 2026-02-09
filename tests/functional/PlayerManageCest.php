<?php

class PlayerManageCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openPlayerIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/player/manage/index');
        $I->see('Players', 'h1');
    }

    public function openPlayerCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/player/manage/create');
        $I->see('Create Player', 'h1');
    }

    public function createPlayerWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/player/manage/create');
        $I->submitForm('form', [
            'Player[username]' => '',
            'Player[password]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Username cannot be blank');
        $I->see('Password cannot be blank');
    }

    public function createPlayerWithInvalidEmail(\FunctionalTester $I)
    {
        $I->amOnRoute('/player/manage/create');
        $I->submitForm('form', [
            'Player[username]' => 'testplayer',
            'Player[email]' => 'invalid-email',
            'Player[password]' => 'testpassword',
        ]);
        $I->expectTo('see validation error for email');
        $I->see('Email is not a valid email address');
    }

    public function createPlayerSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/player/manage/create');
        $I->submitForm('form', [
            'Player[username]' => 'newplayer',
            'Player[email]' => 'newplayer@example.com',
            'Player[password]' => 'securepassword',
            'Player[status]' => 'active',
        ]);
        $I->expectTo('see player created');
        $I->see('newplayer');
    }
}
