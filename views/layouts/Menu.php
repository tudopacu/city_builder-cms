<?php
namespace app\views\layouts;

use app\models\User;
use Yii;
use yii\bootstrap5\Html;

class Menu
{
    public static function getMenu(): array
    {
        $menu =  [];

        if (!Yii::$app->user->isGuest) {
            $menu = [
                ['label' => 'Tup2', 'url' => ['/site/index']],
                ['label' => 'Users', 'url' => ['/user']],
                [
                    'label' => 'Players',
                    'items' => [
                        ['label' => 'Players', 'url' => ['/player']],
                        ['label' => 'Buildings', 'url' => ['/player/player-building']],
                        ['label' => 'Inventories', 'url' => ['/player/player-inventory']],
                        ['label' => 'Inventory Items', 'url' => ['/player/player-inventory-item']],
                        ['label' => 'Productions', 'url' => ['/player/player-building-production']],
                    ],
                ],
                [
                    'label' => 'Maps',
                    'items' => [
                        ['label' => 'Maps', 'url' => ['/map']],
                        ['label' => 'Terrain', 'url' => ['/map/terrain']],
                        ['label' => 'Tiles', 'url' => ['/map/tile']],
                    ],
                ],
                [
                    'label' => 'Buildings',
                    'items' => [
                        ['label' => 'Buildings', 'url' => ['/building']],
                        ['label' => 'Categories', 'url' => ['/building/building-category']],
                        ['label' => 'Levels', 'url' => ['/building/building-level']],
                        ['label' => 'Construction Costs', 'url' => ['/building/building-construction-cost']],
                        ['label' => 'Production', 'url' => ['/building/building-production']],
                    ],
                ],
                [
                    'label' => 'Items',
                    'items' => [
                        ['label' => 'Items', 'url' => ['/item']],
                        ['label' => 'Recipes', 'url' => ['/item/item-recipe']],
                        ['label' => 'Recipes Inputs', 'url' => ['/item/item-recipe-input']],
                    ],
                ],
                ['label' => 'News', 'url' => ['/news']],
                [
                    'label' => 'Roads',
                    'items' => [
                        ['label' => 'Road Types', 'url' => ['/road']],
                        ['label' => 'Roads', 'url' => ['/road/road']],
                        ['label' => 'Intersections', 'url' => ['/road/intersection']],
                    ],
                ],
                ['label' => 'Redis', 'url' => ['/redis']],
            ];
        }

        $menu[] =Yii::$app->user->isGuest
            ? ['label' => 'Login', 'url' => ['/site/login']]
            : '<li class="nav-item">'
            . Html::beginForm(['/site/logout'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'nav-link btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';

        if (Yii::$app->user->isGuest && !User::find()->exists()) {
            $menu[] = ['label' => 'Create User', 'url' => ['/user/manage/create-first-user']];
        }

        return $menu;
    }
}