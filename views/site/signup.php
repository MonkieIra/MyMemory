<link rel="stylesheet" href="css/style.css">

<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\SignupForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Новый дневник';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">


<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'signup-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

        
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'email')->textInput()?>
            <?= $form->field($model, 'birthday')->textInput(['type' => 'date']) ?>
            <?= $form->field($model, 'hobbie_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Hobbie::find()->all(), 'id','hobbie')) ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>
            <div class="form-group">
                <div>
                    <?= Html::submitButton('Создать дневник', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>