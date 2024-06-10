<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hobbie $model */

$this->title = 'Create Hobbie';
$this->params['breadcrumbs'][] = ['label' => 'Hobbies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hobbie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
