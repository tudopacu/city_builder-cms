<?php
namespace app\views\layouts;

use Yii;
use yii\bootstrap5\Html;

class Menu
{
    public static function getMenu(): array
    {
        $menu =  [];

        if (!Yii::$app->user->isGuest) {
            $menu = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Users', 'url' => ['/user']],
                [
                    'label' => 'Players',
                    'items' => [
                        ['label' => 'Players', 'url' => ['/player']],
                        ['label' => 'Players Buildings', 'url' => ['/player/player-building']],
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
                        ['label' => 'Buildings Categories', 'url' => ['/building/building-category']],
                        ['label' => 'Buildings Levels', 'url' => ['/building/building-level']],
                    ],
                ],
                ['label' => 'Items', 'url' => ['/item']],
                ['label' => 'News', 'url' => ['/news']]
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

        return $menu;
    }
}