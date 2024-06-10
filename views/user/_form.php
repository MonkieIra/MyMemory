<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Hobbie;
use app\models\UserRole;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'hobbie_id')->dropDownList(
        Hobbie::find()->select(['hobbie', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Выбрать']
    ) ?>

<?php 
    // Если у пользователя роль отлична от 2, то отключаем поле для выбора роли
    if (Yii::$app->user->identity->role_id != 2): ?>
        <?= $form->field($model, 'role_id')->hiddenInput()->label(false) ?>
    <?php else: ?>
        <?= $form->field($model, 'role_id')->dropDownList(
            UserRole::find()->select(['role', 'id'])->indexBy('id')->column(),
            ['prompt' => 'Выбрать']
        ) ?>
    <?php endif; ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

