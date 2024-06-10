<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Hobbie;

/** @var yii\web\View $this */
/** @var app\models\DailyNotes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="daily-notes-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput(['value' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'hobbie_id')->dropDownList(
        Hobbie::find()->select(['hobbie', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Выбрать']
    ) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
