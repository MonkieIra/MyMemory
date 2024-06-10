<link rel="stylesheet" href="css/style.css">
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\User;
use app\models\Rating;
use app\models\Articles;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Articles $model */
/** @var User $user */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="articles-view container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="article-content">
                <div class="article-details">
                    <h1><?= Html::encode($model->title) ?></h1>
                    <div class="article-image"> 
                        <?= Html::img(Yii::getAlias('uploads/') . $model->img_art, ['class' => 'img-fluid', 'alt' => 'Article Image']) ?> 
                    </div>
                    <p class="article-text"><?= $model->text?></p>
                    <div class="actions">
                        <?php if ($model->user_id === Yii::$app->user->id): ?>
                            <?= Html::a('<i class="far fa-edit"></i> Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('<i class="far fa-trash-alt"></i> Удалить', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php endif; ?>
                        <?php if (!Yii::$app->user->isGuest): ?>

                        <!-- РЕЙТИНГ -->
                        <div class="div-stars">
                            <div>
                                <p>Общий рейтинг: 
                                <?php 
                                    $averageRating = $model->getAverageRating();
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($averageRating > $i) {
                                            echo '★'; // звезда для активного рейтинга
                                        } else {
                                            echo '☆'; // пустая звезда для неактивного рейтинга
                                        }
                                    }
                                ?>
                                </p>
                            </div>

                            <div>
                                <?php

                                // Получаем идентификатор пользователя
                                $userId = Yii::$app->user->identity->id;
                                

                                // Получаем рейтинг пользователя для данной статьи
                                $userRating = Rating::find()
                                    ->select('rating')
                                    ->where(['user_id' => $userId, 'article_id' => $model->id])
                                    ->scalar(); // Получаем одно значение из запроса

                                // Выводим оценку пользователя
                                if ($userRating !== false) {
                                    echo "<p>Ваша оценка: " . $userRating  . "</p>"; // Выводим оценку пользователя
                                } else {
                                    echo "<p>Вы еще не оценили эту статью.</p>";
                                }
                                ?>

                                <!-- Форма для оценки статьи -->
                                <?php $form = ActiveForm::begin(['action' => ['rate', 'id' => $model->id]]); ?>
                                <?php 
                                // Создаем экземпляр модели Rating
                                $ratingModel = new \app\models\Rating(); 
                                ?>
                                <?= $form->field($ratingModel, 'rating')->textInput(['type' => 'number', 'min' => 1, 'max' => 5, 'placeholder' => 'от 1 до 5']) ?>

                                <div class="form-group">
                                    <?= Html::submitButton('<i class="far fa-heart"></i> Оценить', ['class' => 'btn btn-primary']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        
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

.article-content .article-details h1 {
    font-size: 35px;
    
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
