<link rel="stylesheet" href="css/style.css">
<?php

use app\models\Mood;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\NotesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerCss("
    .mood-link {
        color: #6c757d; /* Цвет текста хэштега */
        text-decoration: none; /* Убираем подчеркивание */
    }

    .mood-link:hover {
        color: #343a40; /* Изменяем цвет текста при наведении */
    }
");

$this->title = 'Записи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <?php foreach ($dataProvider->models as $model): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php if ($model->img): ?>
                            <?= '<img alt="" src="uploads/'.$model->img.'" style="max-height: 150px;" class="card-img-top mb-3">' ?>
                        <?php endif; ?>
                        <?php if ($model->mood): ?>
                            <p class="card-text"><strong>День прошел:</strong> <?= Html::a(Html::encode(Mood::findOne($model->mood_id)->mood), ['notes/index', 'NotesSearch[mood_id]' => $model->mood_id], ['class' => 'mood-link']) ?></p>
                        <?php endif; ?>
                        <h5 class="card-title"><?= Html::encode($model->date) ?></h5>
                        <p class="card-text"><?= mb_substr($model->text, 0, 100) . '...' ?></p>
                        <div class="btn-group">
                            <?= Html::a('Подробнее', ['view', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
