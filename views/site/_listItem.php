<?php
use yii\helpers\Html;
use app\models\Notes;
use app\models\Mood;
?>

<div class="list-item">
    <?php 
    $colors = [
        'rgba(192, 23, 28, 0.7)',  // Красный #C0171C
    'rgba(252, 62, 90, 0.7)',  // Красный #FC3E5A
    'rgba(255, 125, 129, 0.7)', // Красный #FF7D81
    'rgba(255, 168, 175, 1)', // Красный #FFA8AF
    'rgba(255, 144, 67, 0.7)', // Красный #FF903F
    ];
    $colorIndex = $index % count($colors);
    $colorStyle = "background-color: {$colors[$colorIndex]}; width: 20px; height: 20px; display: inline-block; margin-right: 10px";
    ?>
    <h5>
        <span class="color-box" style="<?= $colorStyle ?>"></span>
        <span class="product-name"><?= Html::encode($model->mood->mood) ?></span>
    </h5>
    <h5>Частота: <?= $model->frequency ?></h5>

    
</div>
