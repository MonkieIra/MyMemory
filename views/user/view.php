<link rel="stylesheet" href="css/style.css">
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="user-view container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="user-content">
                <h1><?= Html::encode($this->title) ?></h1>


                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> <?= $model->id ?></p>
                        <p><strong>Имя:</strong> <?= Html::encode($model->name) ?></p>
                        <p><strong>Email:</strong> <?= Html::encode($model->email) ?></p>
                        <p><strong>День рождения:</strong> <?= Html::encode($model->birthday) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Роль:</strong> <?= Html::encode($model->role->role) ?></p>
                        <p><strong>Хобби:</strong> <?= Html::encode($model->hobbie->hobbie) ?></p>
                        <p><strong>Логин:</strong> <?= Html::encode($model->username) ?></p>
                        <p><strong>Пароль:</strong> <?= str_repeat('•', strlen($model->password)) ?></p>
                    </div>
                    <p class="btn-container">
                    <?= Html::a('<i class="far fa-edit"></i> Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<i class="far fa-trash-alt"></i> Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
.user-view {
    margin-top: 50px;
}

.user-content {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.user-content h1 {
    font-size: 28px;
    margin-bottom: 20px;
}

.user-content .btn-container {
    margin-bottom: 20px;
}

.user-content .btn {
    margin-right: 10px;
}
</style>
