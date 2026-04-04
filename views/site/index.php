<?php

/** @var yii\web\View $this */
/** @var yii\web\Controller $items */
/** @var yii\web\Controller $relativeUrl */

use yii\bootstrap5\Carousel;

$this->title = 'City Builder CMS';
?>

<div class="container">
    <?php
    if (!empty($items)) {
        echo Carousel::widget([
            'items' => $items,
            'showIndicators' => true,
            'controls' => [
                '<span class="carousel-control-prev-icon" aria-hidden="true"></span>',
                '<span class="carousel-control-next-icon" aria-hidden="true"></span>',
            ],
        ]);
    } else {
        echo '<p class="alert alert-warning">No images found in ' . $relativeUrl . '</p>';
    }
    ?>
</div>
