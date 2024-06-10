<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FavoriteArticles $model */

$this->title = 'Create Favorite Articles';
$this->params['breadcrumbs'][] = ['label' => 'Favorite Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorite-articles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
