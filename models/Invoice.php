<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property int $id
 * @property int $player_id
 * @property float $amount
 * @property string $currency
 * @property string $status
 * @property string|null $smartbill_invoice_number
 * @property string|null $smartbill_series
 * @property string|null $description
 * @property string|null $issued_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Player $player
 */
class Invoice extends CoreModel
{
    const STATUS_DRAFT = 'draft';
    const STATUS_ISSUED = 'issued';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player_id', 'amount'], 'required'],
            [['player_id'], 'integer'],
            [['amount'], 'number', 'min' => 0],
            [['issued_at', 'created_at', 'updated_at'], 'safe'],
            [['currency'], 'string', 'max' => 3],
            [['status'], 'string', 'max' => 32],
            [['smartbill_invoice_number', 'smartbill_series'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 512],
            [['status'], 'in', 'range' => [
                self::STATUS_DRAFT,
                self::STATUS_ISSUED,
                self::STATUS_PAID,
                self::STATUS_CANCELLED,
            ]],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::class, 'targetAttribute' => ['player_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'player_id' => 'Player',
            'amount' => 'Amount',
            'currency' => 'Currency',
            'status' => 'Status',
            'smartbill_invoice_number' => 'Smartbill Invoice Number',
            'smartbill_series' => 'Smartbill Series',
            'description' => 'Description',
            'issued_at' => 'Issued At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Player]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Player::class, ['id' => 'player_id']);
    }

    /**
     * Returns all available statuses.
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ISSUED => 'Issued',
            self::STATUS_PAID => 'Paid',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    /**
     * {@inheritdoc}
     * @return InvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InvoiceQuery(get_called_class());
    }
}
