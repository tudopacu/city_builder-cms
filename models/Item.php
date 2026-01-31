<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property string|null $icon_url
 * @property int $value
 * @property bool $is_tradeable
 * @property int|null $item_recipe_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Item extends CoreModel
{
    const ITEM_TYPES = [
        'raw' => 'Raw',
        'compound' => 'Compound',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icon_url', 'description', 'updated_at', 'item_recipe_id'], 'default', 'value' => null],
            [['name', 'type'], 'required'],
            [['description'], 'string'],
            [['item_recipe_id'], 'integer'],
            [['is_tradeable'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'icon_url'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
            [['type'], 'in', 'range' => array_keys(self::ITEM_TYPES)],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'type' => 'Type',
            'icon_url' => 'Icon URL',
            'is_tradeable' => 'Is Tradeable',
            'item_recipe_id' => 'Item Recipe ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemQuery(get_called_class());
    }
}
