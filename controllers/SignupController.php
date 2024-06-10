<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\SignupForm;

class SignupController extends Controller
{
    public function actionIndex()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Создание записей в обеих таблицах
            $user = new User();
            $user->name = $model->name;
            $user->email = $model->email;
            $user->birthday = $model->birthday;
            $user->hobbie_id = $model->hobbie_id;
            $user->role_id = $model->role_id;
            $user->username = $model->username;
            $user->password = $model->password;

            // Сохраняем пользователя в базу данных
            if ($user->save()) {
                // Автоматически входим в систему после успешной регистрации
                Yii::$app->user->login($user);

                // Отправляем пользователя на главную страницу
                return $this->goHome();
            } else {
                // В случае ошибки сохранения пользователя выводим сообщение об ошибке
                Yii::$app->session->setFlash('error', 'Произошла ошибка при регистрации. Пожалуйста, попробуйте еще раз.');
            }
        }

        // Отображаем форму регистрации
        return $this->render('@app/views/site/signup', [
            'model' => $model,
        ]);
    }
}
