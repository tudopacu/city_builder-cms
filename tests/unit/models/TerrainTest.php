<?php

namespace tests\unit\models;

use app\models\Terrain;

class TerrainTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testTableName()
    {
        verify(Terrain::tableName())->equals('terrains');
    }

    public function testValidationRules()
    {
        $terrain = new Terrain();
        
        // Test required fields
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('map_id'))->true();
        verify($terrain->hasErrors('tile_id'))->true();
        verify($terrain->hasErrors('x'))->true();
        verify($terrain->hasErrors('y'))->true();
    }

    public function testMapIdRequired()
    {
        $terrain = new Terrain();
        $terrain->tile_id = 1;
        $terrain->x = 0;
        $terrain->y = 0;
        
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('map_id'))->true();
    }

    public function testTileIdRequired()
    {
        $terrain = new Terrain();
        $terrain->map_id = 1;
        $terrain->x = 0;
        $terrain->y = 0;
        
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('tile_id'))->true();
    }

    public function testXRequired()
    {
        $terrain = new Terrain();
        $terrain->map_id = 1;
        $terrain->tile_id = 1;
        $terrain->y = 0;
        
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('x'))->true();
    }

    public function testYRequired()
    {
        $terrain = new Terrain();
        $terrain->map_id = 1;
        $terrain->tile_id = 1;
        $terrain->x = 0;
        
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('y'))->true();
    }

    public function testMapIdMustBeInteger()
    {
        $terrain = new Terrain();
        $terrain->map_id = 'not-an-integer';
        $terrain->tile_id = 1;
        $terrain->x = 0;
        $terrain->y = 0;
        
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('map_id'))->true();
    }

    public function testTileIdMustBeInteger()
    {
        $terrain = new Terrain();
        $terrain->map_id = 1;
        $terrain->tile_id = 'not-an-integer';
        $terrain->x = 0;
        $terrain->y = 0;
        
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('tile_id'))->true();
    }

    public function testXMustBeInteger()
    {
        $terrain = new Terrain();
        $terrain->map_id = 1;
        $terrain->tile_id = 1;
        $terrain->x = 'not-an-integer';
        $terrain->y = 0;
        
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('x'))->true();
    }

    public function testYMustBeInteger()
    {
        $terrain = new Terrain();
        $terrain->map_id = 1;
        $terrain->tile_id = 1;
        $terrain->x = 0;
        $terrain->y = 'not-an-integer';
        
        verify($terrain->validate())->false();
        verify($terrain->hasErrors('y'))->true();
    }

    public function testAttributeLabels()
    {
        $terrain = new Terrain();
        $labels = $terrain->attributeLabels();
        
        verify($labels['id'])->equals('ID');
        verify($labels['map_id'])->equals('Map');
        verify($labels['tile_id'])->equals('Tile');
        verify($labels['x'])->equals('X');
        verify($labels['y'])->equals('Y');
        verify($labels['created_at'])->equals('Created At');
        verify($labels['updated_at'])->equals('Updated At');
    }
}
