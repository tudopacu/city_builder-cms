<?php

namespace tests\unit\models;

use app\models\Item;

class ItemTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testTableName()
    {
        verify(Item::tableName())->equals('items');
    }

    public function testItemTypeConstants()
    {
        $expectedTypes = [
            'raw' => 'Raw',
            'compound' => 'Compound',
        ];
        
        verify(Item::ITEM_TYPES)->equals($expectedTypes);
    }

    public function testValidationRules()
    {
        $item = new Item();
        
        // Test required fields
        verify($item->validate())->false();
        verify($item->hasErrors('name'))->true();
        verify($item->hasErrors('type'))->true();
    }

    public function testNameRequired()
    {
        $item = new Item();
        $item->type = 'raw';
        
        verify($item->validate())->false();
        verify($item->hasErrors('name'))->true();
    }

    public function testTypeRequired()
    {
        $item = new Item();
        $item->name = 'Test Item';
        
        verify($item->validate())->false();
        verify($item->hasErrors('type'))->true();
    }

    public function testTypeInRange()
    {
        $item = new Item();
        $item->name = 'Test Item';
        $item->type = 'invalid-type';
        
        verify($item->validate())->false();
        verify($item->hasErrors('type'))->true();
    }

    public function testValidRawType()
    {
        $item = new Item();
        $item->name = 'Test Item';
        $item->type = 'raw';
        
        verify($item->validate(['name', 'type']))->true();
        verify($item->hasErrors('type'))->false();
    }

    public function testValidCompoundType()
    {
        $item = new Item();
        $item->name = 'Test Item';
        $item->type = 'compound';
        
        verify($item->validate(['name', 'type']))->true();
        verify($item->hasErrors('type'))->false();
    }

    public function testNameMaxLength()
    {
        $item = new Item();
        $item->name = str_repeat('a', 256); // 256 characters, exceeds max of 255
        $item->type = 'raw';
        
        verify($item->validate())->false();
        verify($item->hasErrors('name'))->true();
    }

    public function testIconUrlMaxLength()
    {
        $item = new Item();
        $item->name = 'Test Item';
        $item->icon_url = str_repeat('a', 256); // 256 characters, exceeds max of 255
        $item->type = 'raw';
        
        verify($item->validate())->false();
        verify($item->hasErrors('icon_url'))->true();
    }

    public function testTypeMaxLength()
    {
        $item = new Item();
        $item->name = 'Test Item';
        $item->type = str_repeat('a', 51); // 51 characters, exceeds max of 50
        
        verify($item->validate())->false();
        verify($item->hasErrors('type'))->true();
    }

    public function testIsTradeableBoolean()
    {
        $item = new Item();
        $item->name = 'Test Item';
        $item->type = 'raw';
        $item->is_tradeable = 'not-a-boolean';
        
        verify($item->validate())->false();
        verify($item->hasErrors('is_tradeable'))->true();
    }

    public function testIsTradeableTrue()
    {
        $item = new Item();
        $item->name = 'Test Item';
        $item->type = 'raw';
        $item->is_tradeable = true;
        
        verify($item->validate(['name', 'type', 'is_tradeable']))->true();
        verify($item->hasErrors('is_tradeable'))->false();
    }

    public function testIsTradeableFalse()
    {
        $item = new Item();
        $item->name = 'Test Item';
        $item->type = 'raw';
        $item->is_tradeable = false;
        
        verify($item->validate(['name', 'type', 'is_tradeable']))->true();
        verify($item->hasErrors('is_tradeable'))->false();
    }

    public function testAttributeLabels()
    {
        $item = new Item();
        $labels = $item->attributeLabels();
        
        verify($labels['id'])->equals('ID');
        verify($labels['name'])->equals('Name');
        verify($labels['description'])->equals('Description');
        verify($labels['type'])->equals('Type');
        verify($labels['icon_url'])->equals('Icon URL');
        verify($labels['is_tradeable'])->equals('Is Tradeable');
        verify($labels['created_at'])->equals('Created At');
        verify($labels['updated_at'])->equals('Updated At');
    }
}
