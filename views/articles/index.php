<link rel="stylesheet" href="css/style.css">
<?php

use yii\helpers\Html;
use app\models\Hashtag;
use app\models\FavoriteArticles;
use app\models\Articles;


/** @var yii\web\View $this */
/** @var app\models\ArticlesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// CSS стили для хэштегов
$this->registerCss("
    .hashtag-link {
        color: #6c757d; /* Цвет текста хэштега */
        text-decoration: none; /* Убираем подчеркивание */
    }

    .hashtag-link:hover {
        color: #343a40; /* Изменяем цвет текста при наведении */
    }
");

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>






        <p style="display: flex;">
            <?= Html::a('Создать статью', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Избранные статьи', ['/articles/favorites'], ['class' => 'btn btn-success']) ?>

        </p>
        
    

    <div class="row">
        <?php foreach ($dataProvider->models as $model): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                    <?= '<img alt="" src="uploads/'.$model->img_art.'" style="max-height: 150px;" class="card-img-top mb-3">' ?>
                        <h5 class="card-title">
                            <?= Html::a(Html::encode(Hashtag::findOne($model->hastag_id)->hashtag), ['articles/index', 'ArticlesSearch[hastag_id]' => $model->hastag_id], ['class' => 'hashtag-link']) ?>
                        </h5>
                        <p class="card-text"><?= mb_substr($model->text, 0, 100) . '...' ?></p>
                        <p class="card-text">Автор: <?= Html::encode($model->user->username) ?></p>
                        
                        
                       

                        <div class="card-favorite">
                             <?= Html::a('Подробнее', ['view', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?php if (!Yii::$app->user->isGuest): ?>
                        <!-- Добавление/удаление из избранного -->
                        <?php
                        $favorite = FavoriteArticles::find()
                            ->where(['user_id' => Yii::$app->user->id, 'article_id' => $model->id])
                            ->one();

                            if ($favorite !== null) {
                                echo Html::a('Убрать из избранного', ['articles/remove-from-favorites', 'article_id' => $model->id], ['class' => 'btn btn-primary btn-sm']);
                            } else {
                                echo Html::a('Добавить в избранное', ['articles/add-to-favorites', 'article_id' => $model->id], ['class' => 'btn btn-primary btn-sm']);
                            }
                        ?>
                        <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
