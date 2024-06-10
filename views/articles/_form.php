<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Hashtag;
use app\models\User;
use vova07\imperavi\Widget;

/** @var yii\web\View $this */
/** @var app\models\Articles $model */
/** @var yii\widgets\ActiveForm $form */

// Получаем ID текущего авторизованного пользователя
$currentUserId = \Yii::$app->user->identity->id;

// Получаем все хэштеги из таблицы Hashtag
$hashtags = Hashtag::find()->all();

// Формируем ассоциативный массив для использования в выпадающем списке
$hashtagsList = [];
foreach ($hashtags as $hashtag) {
    $hashtagsList[$hashtag->id] = $hashtag->hashtag;
}

?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    

    <?= $form->field($model, 'hastag_id')->dropDownList($hashtagsList, ['prompt' => 'Выбрать']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 200,
        'plugins' => [
            'clips',
            'fullscreen',
        ],
        'clips' => [
            ['Lorem ipsum...', 'Lorem...'],
            ['red', '<span class="label-red">red</span>'],
            ['green', '<span class="label-green">green</span>'],
            ['blue', '<span class="label-blue">blue</span>'],
        ],
    ],
]);?>

    <!-- Скрытое поле для передачи ID текущего пользователя -->
    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $currentUserId])->label(false) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
