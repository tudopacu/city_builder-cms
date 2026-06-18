<?php

class BuildingCategoryCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openBuildingCategoryIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/building/building-category/index');
        $I->see('Building Categories', 'h1');
    }

    public function openBuildingCategoryCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/building/building-category/create');
        $I->see('Create Building Category', 'h1');
    }

    public function createBuildingCategoryWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/building/building-category/create');
        $I->submitForm('form', [
            'BuildingCategory[name]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Name cannot be blank');
    }

    public function createBuildingCategorySuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/building/building-category/create');
        $I->submitForm('form', [
            'BuildingCategory[name]' => 'Test Category',
            'BuildingCategory[description]' => 'A test building category',
        ]);
        $I->expectTo('see building category created');
        $I->see('Test Category');
    }
}
