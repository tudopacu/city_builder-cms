<?php

class MapManageCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openMapIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/manage/index');
        $I->see('Maps', 'h1');
    }

    public function openMapCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/manage/create');
        $I->see('Create Map', 'h1');
    }

    public function createMapWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/manage/create');
        $I->submitForm('form', [
            'Map[name]' => '',
            'Map[width]' => '',
            'Map[length]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Name cannot be blank');
        $I->see('Width cannot be blank');
        $I->see('Length cannot be blank');
    }

    public function createMapWithInvalidDimensions(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/manage/create');
        $I->submitForm('form', [
            'Map[name]' => 'Test Map',
            'Map[width]' => 'not-a-number',
            'Map[length]' => 'not-a-number',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Width must be an integer');
        $I->see('Length must be an integer');
    }

    public function createMapSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/manage/create');
        $I->submitForm('form', [
            'Map[name]' => 'Test Map',
            'Map[width]' => '100',
            'Map[length]' => '100',
        ]);
        $I->expectTo('see map created');
        $I->see('Test Map');
    }
}
