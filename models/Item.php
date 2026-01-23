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
 * @property string $rarity
 * @property string|null $icon_url
 * @property int $max_stack
 * @property int $value
 * @property bool $is_tradeable
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Item extends CoreModel
{
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
            [['icon_url', 'description', 'updated_at'], 'default', 'value' => null],
            [['name', 'type'], 'required'],
            [['description'], 'string'],
            [['max_stack', 'value'], 'integer'],
            [['is_tradeable'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'icon_url'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
            [['rarity'], 'string', 'max' => 20],
            [['rarity'], 'in', 'range' => ['common', 'uncommon', 'rare', 'epic', 'legendary']],
            [['type'], 'in', 'range' => ['resource', 'building_material', 'consumable', 'quest', 'decoration']],
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
            'rarity' => 'Rarity',
            'icon_url' => 'Icon URL',
            'max_stack' => 'Max Stack',
            'value' => 'Value',
            'is_tradeable' => 'Is Tradeable',
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
