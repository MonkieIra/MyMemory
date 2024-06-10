<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Mood;
use vova07\imperavi\Widget;

/** @var yii\web\View $this */
/** @var app\models\Notes $model */
/** @var yii\widgets\ActiveForm $form */

$moods = Mood::find()->all();
$moodList = [];
foreach ($moods as $mood) {
    $moodList[$mood->id] = $mood->mood;
}

?>

<div class="notes-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

    <?= $form->field($model, 'date')->textInput(['value' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'mood_id')->dropDownList($moodList, ['prompt' => 'Выбрать']) ?>

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

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'audioFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

