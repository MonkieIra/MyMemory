<link rel="stylesheet" href="css/style.css">
<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Notes $model */

$this->title = 'Обновить запись';
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить запись';
?>
<div class="notes-update">

    <div class="container" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
                    </div>
                    <div class="card-body" style="padding: 20px;">
                        <?= $this->render('_form', ['model' => $model]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
