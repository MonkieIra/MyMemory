<link rel="stylesheet" href="css/style.css">
<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\Favorite[] $favorites */


$this->title = 'Избранные статьи';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1 class="center-name"><?= Html::encode($this->title) ?></h1>

<?= ListView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $favorites]),
    'itemView' => '_favorite_item', // Представление для отображения одного избранной статьи
    'summary' => '', // Отключаем отображение информации о количестве записей
    
]) ?>
</div>
