<?php

class ItemManageCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openItemIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/item/manage/index');
        $I->see('Items', 'h1');
    }

    public function openItemCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/item/manage/create');
        $I->see('Create Item', 'h1');
    }

    public function createItemWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/item/manage/create');
        $I->submitForm('form', [
            'Item[name]' => '',
            'Item[type]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Name cannot be blank');
        $I->see('Type cannot be blank');
    }

    public function createItemWithInvalidType(\FunctionalTester $I)
    {
        $I->amOnRoute('/item/manage/create');
        $I->submitForm('form', [
            'Item[name]' => 'Test Item',
            'Item[type]' => 'invalid-type',
        ]);
        $I->expectTo('see validation error for type');
        $I->see('Type is invalid');
    }

    public function createItemSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/item/manage/create');
        $I->submitForm('form', [
            'Item[name]' => 'Test Item',
            'Item[description]' => 'A test item',
            'Item[type]' => 'raw',
            'Item[icon_url]' => '/images/item.png',
            'Item[is_tradeable]' => '1',
        ]);
        $I->expectTo('see item created');
        $I->see('Test Item');
    }
}
