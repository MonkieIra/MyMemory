<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Hashtag $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="hashtag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hashtag')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
