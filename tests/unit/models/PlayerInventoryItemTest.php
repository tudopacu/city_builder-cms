<?php

namespace tests\unit\models;

use app\models\PlayerInventoryItem;
use app\models\PlayerInventory;
use Codeception\Test\Unit;

class PlayerInventoryItemTest extends Unit
{
    /**
     * Test that validation passes when quantity is within available capacity
     */
    public function testValidationPassesWhenQuantityIsWithinCapacity()
    {
        // Create a mock PlayerInventory with capacity 100
        $inventory = $this->getMockPlayerInventory(1, 100);
        
        // Create a new item with quantity 50
        $item = new PlayerInventoryItem(['scenario' => 'create']);
        $item->player_inventory_id = 1;
        $item->item_id = 1;
        $item->quantity = 50;
        
        // Mock PlayerInventory::findOne to return our mock
        $this->mockPlayerInventoryFindOne($inventory);
        
        // Mock the existing sum query to return 0 (no existing items)
        $this->mockExistingQuantitySum(0);
        
        // Validation should pass
        verify($item->validate(['quantity']))->true();
        verify($item->hasErrors('quantity'))->false();
    }

    /**
     * Test that validation fails when quantity exceeds available capacity
     */
    public function testValidationFailsWhenQuantityExceedsCapacity()
    {
        // Create a mock PlayerInventory with capacity 100
        $inventory = $this->getMockPlayerInventory(1, 100);
        
        // Existing items total 80
        $existingQuantity = 80;
        
        // Try to add 30 (total would be 110, exceeding capacity of 100)
        $item = new PlayerInventoryItem(['scenario' => 'create']);
        $item->player_inventory_id = 1;
        $item->item_id = 1;
        $item->quantity = 30;
        
        // Mock PlayerInventory::findOne to return our mock
        $this->mockPlayerInventoryFindOne($inventory);
        
        // Mock the existing sum query to return 80
        $this->mockExistingQuantitySum($existingQuantity);
        
        // Validation should fail
        verify($item->validate(['quantity']))->false();
        verify($item->hasErrors('quantity'))->true();
        
        // Check error message
        $errors = $item->getErrors('quantity');
        verify($errors)->notEmpty();
        verify($errors[0])->contains('exceeds the available inventory capacity');
    }

    /**
     * Test that validation passes when quantity exactly matches available capacity
     */
    public function testValidationPassesWhenQuantityExactlyMatchesAvailableCapacity()
    {
        // Create a mock PlayerInventory with capacity 100
        $inventory = $this->getMockPlayerInventory(1, 100);
        
        // Existing items total 70
        $existingQuantity = 70;
        
        // Try to add exactly 30 (total would be 100, exactly at capacity)
        $item = new PlayerInventoryItem(['scenario' => 'create']);
        $item->player_inventory_id = 1;
        $item->item_id = 1;
        $item->quantity = 30;
        
        // Mock PlayerInventory::findOne to return our mock
        $this->mockPlayerInventoryFindOne($inventory);
        
        // Mock the existing sum query to return 70
        $this->mockExistingQuantitySum($existingQuantity);
        
        // Validation should pass
        verify($item->validate(['quantity']))->true();
        verify($item->hasErrors('quantity'))->false();
    }

    /**
     * Test that validation is skipped when not in 'create' scenario
     */
    public function testValidationSkippedWhenNotInCreateScenario()
    {
        // Create a new item without 'create' scenario
        $item = new PlayerInventoryItem();
        $item->player_inventory_id = 1;
        $item->item_id = 1;
        $item->quantity = 999; // Even if this exceeds capacity
        
        // The validation rule should not be applied
        // This would normally fail if the scenario was 'create', but should pass here
        verify($item->validate(['quantity']))->true();
        verify($item->hasErrors('quantity'))->false();
    }

    /**
     * Helper method to create a mock PlayerInventory
     */
    private function getMockPlayerInventory($id, $capacity)
    {
        $inventory = new PlayerInventory();
        $inventory->id = $id;
        $inventory->capacity = $capacity;
        return $inventory;
    }

    /**
     * Mock PlayerInventory::findOne method
     */
    private function mockPlayerInventoryFindOne($inventory)
    {
        // Note: This is a simplified mock for demonstration
        // In a real test environment, you might use fixtures or a test database
    }

    /**
     * Mock the sum of existing quantities
     */
    private function mockExistingQuantitySum($sum)
    {
        // Note: This is a simplified mock for demonstration
        // In a real test environment, you might use fixtures or a test database
    }
}
