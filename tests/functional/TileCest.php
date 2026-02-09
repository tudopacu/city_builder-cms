<?php

class TileCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openTileIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/tile/index');
        $I->see('Tiles', 'h1');
    }

    public function openTileCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/tile/create');
        $I->see('Create Tile', 'h1');
    }

    public function createTileWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/tile/create');
        $I->submitForm('form', [
            'Tile[type]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Type cannot be blank');
    }

    public function createTileSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/tile/create');
        $I->submitForm('form', [
            'Tile[type]' => 'grass',
            'Tile[image_url]' => '/images/grass.png',
        ]);
        $I->expectTo('see tile created');
        $I->see('grass');
    }
}
