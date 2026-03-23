<?php

namespace tests\unit\models;

use app\models\Invoice;
use Codeception\Test\Unit;

/**
 * Test cases for Invoice model validation
 */
class InvoiceTest extends Unit
{
    /**
     * Test that Invoice model has correct table name
     */
    public function testTableName()
    {
        verify(Invoice::tableName())->equals('invoices');
    }

    /**
     * Test that status constants are defined
     */
    public function testStatusConstants()
    {
        verify(Invoice::STATUS_DRAFT)->equals('draft');
        verify(Invoice::STATUS_ISSUED)->equals('issued');
        verify(Invoice::STATUS_PAID)->equals('paid');
        verify(Invoice::STATUS_CANCELLED)->equals('cancelled');
    }

    /**
     * Test that getStatuses() returns all status options
     */
    public function testGetStatuses()
    {
        $statuses = Invoice::getStatuses();
        verify($statuses)->arrayHasKey(Invoice::STATUS_DRAFT);
        verify($statuses)->arrayHasKey(Invoice::STATUS_ISSUED);
        verify($statuses)->arrayHasKey(Invoice::STATUS_PAID);
        verify($statuses)->arrayHasKey(Invoice::STATUS_CANCELLED);
    }

    /**
     * Test required fields validation
     */
    public function testRequiredFields()
    {
        $model = new Invoice();
        $model->validate();

        verify($model->hasErrors('player_id'))->true();
        verify($model->hasErrors('amount'))->true();
    }

    /**
     * Test that amount must be non-negative
     */
    public function testAmountValidation()
    {
        $model = new Invoice();
        $model->amount = -10;
        $model->validate(['amount']);
        verify($model->hasErrors('amount'))->true();

        $model->amount = 0;
        $model->clearErrors('amount');
        $model->validate(['amount']);
        verify($model->hasErrors('amount'))->false();

        $model->amount = 99.99;
        $model->clearErrors('amount');
        $model->validate(['amount']);
        verify($model->hasErrors('amount'))->false();
    }

    /**
     * Test status validation rejects invalid values
     */
    public function testStatusValidation()
    {
        $model = new Invoice();
        $model->status = 'invalid_status';
        $model->validate(['status']);
        verify($model->hasErrors('status'))->true();
    }

    /**
     * Test that valid status values pass validation
     */
    public function testValidStatusValues()
    {
        foreach (array_keys(Invoice::getStatuses()) as $status) {
            $model = new Invoice();
            $model->status = $status;
            $model->clearErrors('status');
            $model->validate(['status']);
            verify($model->hasErrors('status'))->false();
        }
    }

    /**
     * Test default currency is RON
     */
    public function testDefaultCurrency()
    {
        $model = new Invoice();
        $model->loadDefaultValues();
        verify($model->currency)->equals('RON');
    }

    /**
     * Test default status is draft
     */
    public function testDefaultStatus()
    {
        $model = new Invoice();
        $model->loadDefaultValues();
        verify($model->status)->equals(Invoice::STATUS_DRAFT);
    }

    /**
     * Test that find() returns InvoiceQuery
     */
    public function testFindReturnsInvoiceQuery()
    {
        $query = Invoice::find();
        verify($query)->instanceOf(\app\models\InvoiceQuery::class);
    }

    /**
     * Test attribute labels are defined
     */
    public function testAttributeLabels()
    {
        $model = new Invoice();
        $labels = $model->attributeLabels();

        verify($labels)->arrayHasKey('id');
        verify($labels)->arrayHasKey('player_id');
        verify($labels)->arrayHasKey('amount');
        verify($labels)->arrayHasKey('currency');
        verify($labels)->arrayHasKey('status');
        verify($labels)->arrayHasKey('smartbill_invoice_number');
        verify($labels)->arrayHasKey('smartbill_series');
        verify($labels)->arrayHasKey('description');
        verify($labels)->arrayHasKey('issued_at');
    }
}
