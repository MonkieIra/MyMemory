<link rel="stylesheet" href="css/style.css">
<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Plans $model */

$this->title = 'Создать план';
$this->params['breadcrumbs'][] = ['label' => 'Планы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plans-create">

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
