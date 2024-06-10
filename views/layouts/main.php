
<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/web/img/2.svg" alt="MyMemory">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-md navbar-dark ',
            'style' => 'background-color: transparent;'
        ]
    ]);
    
    

    // Определение элементов меню в зависимости от статуса пользователя
    $menuItems = [];

    // Если пользователь авторизован, добавляем ссылку на страницу пользователей и для выхода
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Записи', 'url' => ['/notes/index']];
        $menuItems[] = ['label' => 'Статьи', 'url' => ['/articles/index']];
        $menuItems[] = ['label' => 'Планы', 'url' => ['/plans/index']];
        $menuItems[] = ['label' => 'Цитата дня', 'url' => ['/daily-notes/index']];
        $menuItems[] = ['label' => 'Статистика', 'url' => ['/site/statistic']];
        $menuItems[] = ['label' => 'Профиль', 'url' => ['/user/index']];
        $menuItems[] = '<li class="nav-item">'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'nav-link btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>


<style>
    .nav-link {
    color: #000 !important;
    }
    .navbar > .container{
        margin-top: 30px;
    }
    .breadcrumb{
       display:none;
    }


</style>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
