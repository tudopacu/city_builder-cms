<?php

namespace tests\unit\models;

use app\models\PlayerInventoryItem;
use app\models\PlayerInventory;
use Codeception\Test\Unit;

/**
 * Test cases for PlayerInventoryItem validation
 * 
 * Note: These tests are documented test cases that describe the expected behavior.
 * To run these tests, you need to set up test fixtures or a test database with:
 * - A PlayerInventory record with id=1 and capacity=100
 * - PlayerInventoryItem records that sum to the appropriate quantities
 * 
 * The validation logic ensures that when creating a new PlayerInventoryItem:
 * - new_quantity <= (inventory.capacity - sum(existing_items.quantity))
 */
class PlayerInventoryItemTest extends Unit
{
    /**
     * Test that the validation rule exists and is configured for 'create' scenario
     */
    public function testValidationRuleExists()
    {
        $model = new PlayerInventoryItem(['scenario' => 'create']);
        $rules = $model->rules();
        
        // Check that the validateInventoryCapacity rule exists
        $hasValidationRule = false;
        foreach ($rules as $rule) {
            if (isset($rule[1]) && $rule[1] === 'validateInventoryCapacity') {
                $hasValidationRule = true;
                // Verify it's only on 'create' scenario
                verify(isset($rule['on']))->true();
                verify($rule['on'])->equals('create');
                break;
            }
        }
        
        verify($hasValidationRule)->true();
    }

    /**
     * Test that validation method exists
     */
    public function testValidationMethodExists()
    {
        $model = new PlayerInventoryItem(['scenario' => 'create']);
        verify(method_exists($model, 'validateInventoryCapacity'))->true();
    }

    /**
     * Test that basic validation rules are intact
     */
    public function testBasicValidationRules()
    {
        $model = new PlayerInventoryItem(['scenario' => 'create']);
        
        // Test required fields
        $model->validate();
        verify($model->hasErrors('player_inventory_id'))->true();
        verify($model->hasErrors('item_id'))->true();
        
        // Test that quantity must be non-negative integer
        $model->quantity = -5;
        $model->validate(['quantity']);
        verify($model->hasErrors('quantity'))->true();
        
        $model->quantity = 0;
        $model->validate(['quantity']);
        // Should not have min value error (0 is valid)
        $errors = $model->getErrors('quantity');
        if (!empty($errors)) {
            verify($errors[0])->notContains('must be no less');
        }
    }

    /**
     * Test that scenario is properly set
     */
    public function testScenarioConfiguration()
    {
        $modelWithScenario = new PlayerInventoryItem(['scenario' => 'create']);
        verify($modelWithScenario->scenario)->equals('create');
        
        $modelWithoutScenario = new PlayerInventoryItem();
        verify($modelWithoutScenario->scenario)->notEquals('create');
    }
}

/**
 * Manual Test Cases (require database setup):
 * 
 * Test Case 1: Validation passes when quantity is within available capacity
 * Setup:
 *   - PlayerInventory: capacity = 100
 *   - Existing items sum = 0
 * Action:
 *   - Create new item with quantity = 50
 * Expected:
 *   - Validation PASSES (50 <= 100)
 * 
 * Test Case 2: Validation fails when quantity exceeds available capacity
 * Setup:
 *   - PlayerInventory: capacity = 100
 *   - Existing items sum = 80
 * Action:
 *   - Create new item with quantity = 30
 * Expected:
 *   - Validation FAILS (30 > 20 available)
 *   - Error message: "The quantity (30) exceeds the available inventory capacity (20)..."
 * 
 * Test Case 3: Validation passes when quantity exactly matches available capacity
 * Setup:
 *   - PlayerInventory: capacity = 100
 *   - Existing items sum = 70
 * Action:
 *   - Create new item with quantity = 30
 * Expected:
 *   - Validation PASSES (30 == 30 available)
 * 
 * Test Case 4: Validation is skipped when not in 'create' scenario
 * Setup:
 *   - PlayerInventory: capacity = 100
 *   - Existing items sum = 90
 * Action:
 *   - Update existing item (default scenario)
 *   - Set quantity = 50
 * Expected:
 *   - Validation is NOT applied (scenario is not 'create')
 *   - Update proceeds without capacity check
 */
