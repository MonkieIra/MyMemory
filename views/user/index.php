<link rel="stylesheet" href="css/style.css">
<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php foreach ($dataProvider->getModels() as $user): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= Html::encode($user->name) ?></h5>
                        <p class="card-text"><?= Html::encode($user->email) ?></p>
                        <?php if ($user->hobbie): ?>
                            <p class="card-text"><?= Html::encode($user->hobbie->hobbie) ?></p>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <?= Html::a('Просмотреть', ['user/view', 'id' => $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
