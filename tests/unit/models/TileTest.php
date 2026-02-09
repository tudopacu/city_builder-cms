<?php

namespace tests\unit\models;

use app\models\Tile;

class TileTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testTableName()
    {
        verify(Tile::tableName())->equals('tiles');
    }

    public function testValidationRules()
    {
        $tile = new Tile();
        
        // Test required fields
        verify($tile->validate())->false();
        verify($tile->hasErrors('type'))->true();
    }

    public function testTypeRequired()
    {
        $tile = new Tile();
        
        verify($tile->validate())->false();
        verify($tile->hasErrors('type'))->true();
    }

    public function testTypeMaxLength()
    {
        $tile = new Tile();
        $tile->type = str_repeat('a', 256); // 256 characters, exceeds max of 255
        
        verify($tile->validate())->false();
        verify($tile->hasErrors('type'))->true();
    }

    public function testImageUrlMaxLength()
    {
        $tile = new Tile();
        $tile->type = 'grass';
        $tile->image_url = str_repeat('a', 256); // 256 characters, exceeds max of 255
        
        verify($tile->validate())->false();
        verify($tile->hasErrors('image_url'))->true();
    }

    public function testValidTile()
    {
        $tile = new Tile();
        $tile->type = 'grass';
        $tile->image_url = '/images/grass.png';
        
        verify($tile->validate())->true();
        verify($tile->hasErrors())->false();
    }

    public function testImageUrlIsOptional()
    {
        $tile = new Tile();
        $tile->type = 'water';
        
        verify($tile->validate())->true();
        verify($tile->hasErrors('image_url'))->false();
    }

    public function testAttributeLabels()
    {
        $tile = new Tile();
        $labels = $tile->attributeLabels();
        
        verify($labels['id'])->equals('ID');
        verify($labels['type'])->equals('Type');
        verify($labels['image_url'])->equals('Image Url');
        verify($labels['created_at'])->equals('Created At');
        verify($labels['updated_at'])->equals('Updated At');
    }
}
