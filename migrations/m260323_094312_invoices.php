<?php

use yii\db\Migration;

class m260323_094312_invoices extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoices}}', [
            'id' => $this->primaryKey(),
            'player_id' => $this->integer()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'currency' => $this->string(3)->notNull()->defaultValue('RON'),
            'status' => $this->string(32)->notNull()->defaultValue('draft'),
            'smartbill_invoice_number' => $this->string(64),
            'smartbill_series' => $this->string(32),
            'description' => $this->string(512),
            'issued_at' => $this->dateTime(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk_invoices_player_id',
            '{{%invoices}}',
            'player_id',
            '{{%player}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_invoices_player_id', '{{%invoices}}');
        $this->dropTable('{{%invoices}}');
    }
}
