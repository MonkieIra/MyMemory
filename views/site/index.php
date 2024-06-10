<link rel="stylesheet" href="/web/css/style.css">
<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

use yii\helpers\Url;
use yii\helpers\Html;

$loginUrl = Url::to(['site/login']);
$signupUrl = Url::to(['site/signup']);
?>
<div class="site-index">
    <div class="container">
        <div class="book">
            <div class="book-img">
                <img src="/web/img/1.svg" alt="1">
            </div>
            <div class="book-text">
                <h1>Ваш личный дневник на каждый день!</h1>
                <p>Записывайте всё, что для вас важно </p>
                <div class="book-button">
                    <?= Html::a('Войти', $loginUrl, ['class' => 'btn-1']) ?>
                    <?= Html::a('Зарегистрироваться', $signupUrl, ['class' => 'btn-1']) ?>
                </div>
            </div>
        </div>
    </div>
    