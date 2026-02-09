<?php

class BuildingManageCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openBuildingIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/building/manage/index');
        $I->see('Buildings', 'h1');
    }

    public function openBuildingCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/building/manage/create');
        $I->see('Create Building', 'h1');
    }

    public function createBuildingWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/building/manage/create');
        $I->submitForm('form', [
            'Building[name]' => '',
            'Building[width]' => '',
            'Building[length]' => '',
            'Building[building_category_id]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Name cannot be blank');
        $I->see('Width cannot be blank');
        $I->see('Length cannot be blank');
        $I->see('Building Category ID cannot be blank');
    }

    public function createBuildingSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/building/manage/create');
        $I->submitForm('form', [
            'Building[name]' => 'Test Building',
            'Building[image_url]' => '/images/test.png',
            'Building[description]' => 'A test building',
            'Building[width]' => '2',
            'Building[length]' => '2',
            'Building[building_category_id]' => '1',
        ]);
        $I->expectTo('see building created');
        $I->see('Test Building');
    }
}
