<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hashtag $model */

$this->title = 'Create Hashtag';
$this->params['breadcrumbs'][] = ['label' => 'Hashtags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hashtag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
