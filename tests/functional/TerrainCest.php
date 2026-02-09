<?php

class TerrainCest
{
    public function _before(\FunctionalTester $I)
    {
        // Ensure user is logged in as admin for CRUD operations
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openTerrainIndexPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/terrain/index');
        $I->see('Terrains', 'h1');
    }

    public function openTerrainCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/terrain/create');
        $I->see('Create Terrain', 'h1');
    }

    public function createTerrainWithEmptyForm(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/terrain/create');
        $I->submitForm('form', [
            'Terrain[map_id]' => '',
            'Terrain[tile_id]' => '',
            'Terrain[x]' => '',
            'Terrain[y]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Map ID cannot be blank');
        $I->see('Tile ID cannot be blank');
        $I->see('X cannot be blank');
        $I->see('Y cannot be blank');
    }

    public function createTerrainSuccessfully(\FunctionalTester $I)
    {
        $I->amOnRoute('/map/terrain/create');
        $I->submitForm('form', [
            'Terrain[map_id]' => '1',
            'Terrain[tile_id]' => '1',
            'Terrain[x]' => '5',
            'Terrain[y]' => '10',
        ]);
        $I->expectTo('see terrain created');
        // Terrain view might show coordinates
        $I->see('5');
        $I->see('10');
    }
}
