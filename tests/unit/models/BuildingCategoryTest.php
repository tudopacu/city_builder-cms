<?php

namespace tests\unit\models;

use app\models\BuildingCategory;

class BuildingCategoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testTableName()
    {
        verify(BuildingCategory::tableName())->equals('building_categories');
    }

    public function testValidationRules()
    {
        $category = new BuildingCategory();
        
        // Test required fields
        verify($category->validate())->false();
        verify($category->hasErrors('name'))->true();
    }

    public function testNameRequired()
    {
        $category = new BuildingCategory();
        
        verify($category->validate())->false();
        verify($category->hasErrors('name'))->true();
    }

    public function testNameMaxLength()
    {
        $category = new BuildingCategory();
        $category->name = str_repeat('a', 256); // 256 characters, exceeds max of 255
        
        verify($category->validate())->false();
        verify($category->hasErrors('name'))->true();
    }

    public function testValidCategory()
    {
        $category = new BuildingCategory();
        $category->name = 'Residential';
        $category->description = 'Buildings for housing';
        
        verify($category->validate())->true();
        verify($category->hasErrors())->false();
    }

    public function testDescriptionIsOptional()
    {
        $category = new BuildingCategory();
        $category->name = 'Commercial';
        
        verify($category->validate())->true();
        verify($category->hasErrors('description'))->false();
    }

    public function testAttributeLabels()
    {
        $category = new BuildingCategory();
        $labels = $category->attributeLabels();
        
        verify($labels['id'])->equals('ID');
        verify($labels['name'])->equals('Name');
        verify($labels['description'])->equals('Description');
        verify($labels['created_at'])->equals('Created At');
        verify($labels['updated_at'])->equals('Updated At');
    }
}
