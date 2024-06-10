<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<?php

use app\models\Plans;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Планы';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <p style="display: flex;">
        <?= Html::a('Создать план', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Предыдущие планы', ['previous-plans'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <?php foreach ($dataProvider->models as $model): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div>
                            <small class="text-muted" style="font-size: 23px"><?= Html::encode($model->time) ?></small>
                        </div>
                        <p class="card-text"><?= Html::encode($model->task_text) ?></p>
                        
                        


                        <div class="d-flex justify-content-between align-items-center">
                            <div class="actions">
                                <p>
                                    <?= Html::a('<i class="far fa-edit"></i> Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a('<i class="far fa-check-circle"></i> Выполнено', ['delete', 'id' => $model->id], [
                                        'class' => 'btn btn-primary',
                                        'data' => [
                                            'confirm' => 'Вы выполнили этот план?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

