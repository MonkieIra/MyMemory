<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FavoriteArticles $model */

$this->title = 'Update Favorite Articles: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Favorite Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="favorite-articles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
