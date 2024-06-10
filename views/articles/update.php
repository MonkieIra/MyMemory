<link rel="stylesheet" href="css/style.css">
<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Articles $model */

$this->title = 'Обновить статью';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить статью';
?>
<div class="articles-update">

    <div class="container" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-bottom: 20px;">
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
