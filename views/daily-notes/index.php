<link rel="stylesheet" href="css/style.css">

<?php

use app\models\DailyNotes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Цитата дня';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать цитату', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <?php foreach ($dataProvider->models as $dailyNote): ?>
            <div class="col-md-4 ">
                <div class="card mb-4 shadow-sm">
                <div class="card-body">
                <?= '<img alt="" src="uploads/'.$dailyNote->img.'" style="max-height: 150px;" class="card-img-top mb-3">' ?>
                <?php if ($dailyNote->hobbie): ?>
                    <p class="card-text"><strong>Хобби:</strong><?= Html::encode($dailyNote->hobbie->hobbie) ?></p>
                <?php endif; ?>
                <h5 class="card-title">
                </h5>

    <?= Html::a('Подробнее', ['view', 'id' => $dailyNote->id], ['class' => 'btn btn-primary btn-sm']) ?>
</div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>


    



</div>
