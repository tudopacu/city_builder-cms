<?php

namespace tests\unit\models;

use app\models\Map;

class MapTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testTableName()
    {
        verify(Map::tableName())->equals('maps');
    }

    public function testValidationRules()
    {
        $map = new Map();
        
        // Test required fields
        verify($map->validate())->false();
        verify($map->hasErrors('name'))->true();
        verify($map->hasErrors('width'))->true();
        verify($map->hasErrors('length'))->true();
    }

    public function testNameRequired()
    {
        $map = new Map();
        $map->width = 100;
        $map->length = 100;
        
        verify($map->validate())->false();
        verify($map->hasErrors('name'))->true();
    }

    public function testWidthRequired()
    {
        $map = new Map();
        $map->name = 'Test Map';
        $map->length = 100;
        
        verify($map->validate())->false();
        verify($map->hasErrors('width'))->true();
    }

    public function testLengthRequired()
    {
        $map = new Map();
        $map->name = 'Test Map';
        $map->width = 100;
        
        verify($map->validate())->false();
        verify($map->hasErrors('length'))->true();
    }

    public function testWidthMustBeInteger()
    {
        $map = new Map();
        $map->name = 'Test Map';
        $map->width = 'not-an-integer';
        $map->length = 100;
        
        verify($map->validate())->false();
        verify($map->hasErrors('width'))->true();
    }

    public function testLengthMustBeInteger()
    {
        $map = new Map();
        $map->name = 'Test Map';
        $map->width = 100;
        $map->length = 'not-an-integer';
        
        verify($map->validate())->false();
        verify($map->hasErrors('length'))->true();
    }

    public function testNameMaxLength()
    {
        $map = new Map();
        $map->name = str_repeat('a', 256); // 256 characters, exceeds max of 255
        $map->width = 100;
        $map->length = 100;
        
        verify($map->validate())->false();
        verify($map->hasErrors('name'))->true();
    }

    public function testValidMap()
    {
        $map = new Map();
        $map->name = 'Test Map';
        $map->width = 100;
        $map->length = 100;
        
        verify($map->validate(['name', 'width', 'length']))->true();
        verify($map->hasErrors())->false();
    }

    public function testAttributeLabels()
    {
        $map = new Map();
        $labels = $map->attributeLabels();
        
        verify($labels['id'])->equals('ID');
        verify($labels['name'])->equals('Name');
        verify($labels['width'])->equals('Width');
        verify($labels['length'])->equals('Length');
        verify($labels['created_at'])->equals('Created At');
        verify($labels['updated_at'])->equals('Updated At');
    }
}
