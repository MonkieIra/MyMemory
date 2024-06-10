<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hobbie $model */

$this->title = 'Update Hobbie: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hobbies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hobbie-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
