<?php

class UserManageCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openUserIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/user/manage/index');
        $I->see('Users', 'h1');
    }

    public function openUserCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/user/manage/create');
        $I->see('Create User', 'h1');
    }

    public function createUserWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/user/manage/create');
        $I->submitForm('form', [
            'User[username]' => '',
            'User[email]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Username cannot be blank');
        $I->see('Email cannot be blank');
    }

    public function createUserWithInvalidEmail(\FunctionalTester $I)
    {
        $I->amOnRoute('/user/manage/create');
        $I->submitForm('form', [
            'User[username]' => 'testuser',
            'User[email]' => 'invalid-email',
        ]);
        $I->expectTo('see validation error for email');
        $I->see('Email is not a valid email address');
    }

    public function createUserSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/user/manage/create');
        $I->submitForm('form', [
            'User[username]' => 'newuser',
            'User[email]' => 'newuser@example.com',
            'User[password]' => 'securepassword',
        ]);
        $I->expectTo('see user created');
        $I->see('newuser');
    }
}
