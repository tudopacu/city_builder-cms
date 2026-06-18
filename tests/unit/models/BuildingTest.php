<?php

namespace tests\unit\models;

use app\models\Building;
use app\models\BuildingCategory;

class BuildingTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testTableName()
    {
        verify(Building::tableName())->equals('buildings');
    }

    public function testValidationRules()
    {
        $building = new Building();
        
        // Test required fields
        verify($building->validate())->false();
        verify($building->hasErrors('name'))->true();
        verify($building->hasErrors('width'))->true();
        verify($building->hasErrors('length'))->true();
        verify($building->hasErrors('building_category_id'))->true();
    }

    public function testNameRequired()
    {
        $building = new Building();
        $building->width = 2;
        $building->length = 2;
        $building->building_category_id = 1;
        
        verify($building->validate())->false();
        verify($building->hasErrors('name'))->true();
    }

    public function testWidthRequired()
    {
        $building = new Building();
        $building->name = 'Test Building';
        $building->length = 2;
        $building->building_category_id = 1;
        
        verify($building->validate())->false();
        verify($building->hasErrors('width'))->true();
    }

    public function testLengthRequired()
    {
        $building = new Building();
        $building->name = 'Test Building';
        $building->width = 2;
        $building->building_category_id = 1;
        
        verify($building->validate())->false();
        verify($building->hasErrors('length'))->true();
    }

    public function testBuildingCategoryIdRequired()
    {
        $building = new Building();
        $building->name = 'Test Building';
        $building->width = 2;
        $building->length = 2;
        
        verify($building->validate())->false();
        verify($building->hasErrors('building_category_id'))->true();
    }

    public function testWidthMustBeInteger()
    {
        $building = new Building();
        $building->name = 'Test Building';
        $building->width = 'not-an-integer';
        $building->length = 2;
        $building->building_category_id = 1;
        
        verify($building->validate())->false();
        verify($building->hasErrors('width'))->true();
    }

    public function testLengthMustBeInteger()
    {
        $building = new Building();
        $building->name = 'Test Building';
        $building->width = 2;
        $building->length = 'not-an-integer';
        $building->building_category_id = 1;
        
        verify($building->validate())->false();
        verify($building->hasErrors('length'))->true();
    }

    public function testNameMaxLength()
    {
        $building = new Building();
        $building->name = str_repeat('a', 256); // 256 characters, exceeds max of 255
        $building->width = 2;
        $building->length = 2;
        $building->building_category_id = 1;
        
        verify($building->validate())->false();
        verify($building->hasErrors('name'))->true();
    }

    public function testImageUrlMaxLength()
    {
        $building = new Building();
        $building->name = 'Test Building';
        $building->image_url = str_repeat('a', 256); // 256 characters, exceeds max of 255
        $building->width = 2;
        $building->length = 2;
        $building->building_category_id = 1;
        
        verify($building->validate())->false();
        verify($building->hasErrors('image_url'))->true();
    }

    public function testAttributeLabels()
    {
        $building = new Building();
        $labels = $building->attributeLabels();
        
        verify($labels['id'])->equals('ID');
        verify($labels['name'])->equals('Name');
        verify($labels['image_url'])->equals('Image Url');
        verify($labels['description'])->equals('Description');
        verify($labels['width'])->equals('Width');
        verify($labels['length'])->equals('Length');
        verify($labels['building_category_id'])->equals('Building Category ID');
        verify($labels['created_at'])->equals('Created At');
        verify($labels['updated_at'])->equals('Updated At');
    }
}
