<link rel="stylesheet" href="css/style.css">

<?php

use yii\helpers\Html;
use app\models\Articles;

/** @var yii\web\View $this */
/** @var app\models\Favorite $model */

$articles = Articles::findOne($model->article_id);

?>
<div class="container">
    <div class="row">
         <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
            <div class="card-body">
            <h5 class="card-title">
                            <?= Html::a(Html::encode($articles->title)) ?>
                        </h5>

            <!-- <p class="card-text"><?= mb_substr($articles->text, 0, 100) . '...' ?></p> -->
            <p class="card-text">Автор: <?= Html::encode($model->user->username) ?></p>
            

            <div class="actions">
                <p>
                    <!-- Кнопка для перехода на страницу просмотра статьи -->
            <?= Html::a('Подробнее', ['articles/view', 'id' => $model->article_id], ['class' => 'btn btn-primary btn-sm']) ?>

            <!-- Кнопка для удаления из избранного -->
            <?= Html::a('Убрать из избранного', ['articles/remove-from-favorites', 'article_id' => $articles->id], ['class' => 'btn btn-danger btn-sm']) ?> 
                </p>
               
            </div>

            
        </div>
            </div>
         </div>
    </div>  
</div>

<style>
    
.articles-view {
    margin-top: 50px;
}

.article-content {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.article-content .article-details {
    padding: 20px;
}

.article-content .article-details h1 {
    font-size: 28px;
    margin-bottom: 20px;
}

.article-content .article-details .article-image {
    margin-bottom: 20px;
}

.article-content .article-details .article-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.article-content .article-details .article-text {
    font-size: 18px;
    line-height: 1.8;
}

.article-content .actions {
    margin-top: 20px;
}

.article-content .actions .btn {
    margin-right: 10px;
}
</style>
