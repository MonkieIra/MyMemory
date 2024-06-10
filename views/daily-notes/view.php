<link rel="stylesheet" href="css/style.css">
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\DailyNotes $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Цитата дня', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="articles-view container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="article-content">
            
                <div class="article-details">
                    <div class="article-image"> 
                        <?= Html::img(Yii::getAlias('uploads/') . $model->img, ['class' => 'img-fluid', 'alt' => 'Article Image']) ?> 
                    </div>
                    <div class="article-text">
                        <blockquote class="blockquote">
                            <p class="mb-0"><?= Html::encode($model->text) ?></p>
                            <footer class="blockquote-footer"><?= Html::encode($model->author) ?></footer>
                        </blockquote>
                    </div>
                    <div class="actions">
                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == 2): ?>
                            <?= Html::a('<i class="far fa-edit"></i> Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('<i class="far fa-trash-alt"></i> Удалить', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php endif; ?>
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

.article-content .article-details blockquote {
    /* font-size: 24px; */
    border-left: 5px solid #f7c8cf;
    margin: 0;
    padding: 10px 20px;
}

.article-content .article-details blockquote footer {
    color: #6c757d;
    font-size: 18px;
    margin-top: 10px;
}

.article-content .actions {
    margin-top: 20px;
}

.article-content .actions .btn {
    margin-right: 10px;
}
</style>
