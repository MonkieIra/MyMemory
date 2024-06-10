<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Notes;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/notes/index']); // Перенаправляем на страницу /notes/index после успешного входа
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signup action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->register()) {
                Yii::$app->session->setFlash('success', 'Вы успешно зарегистрировались.');
                return $this->redirect(['/notes/index']); // Перенаправляем на страницу /notes/index после успешной регистрации
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при регистрации.');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    public function actionStatistic() 
    {
        // Получение данных о наиболее часто встречающихся продуктах текущего пользователя
        $statistic = Notes::statistic(Yii::$app->user->id); // Предположим, что у вас есть метод mostProduct($userId) для получения наиболее часто встречающихся продуктов для конкретного пользователя
        
        // Проверка данных
    if (!$statistic) {
        // Сохраняем сообщение о том, что данных еще нет в переменной $message
        $message = 'Данные о настроении еще не доступны.';
    }

        
        // Возвращение представления и передача данных о наиболее часто встречающихся продуктах
        return $this->render('statistic', [
            'statistic' => $statistic,
            'message' => $message ?? null,
        ]);
    }
}
