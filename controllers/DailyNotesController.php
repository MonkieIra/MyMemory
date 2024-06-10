<?php

namespace app\controllers;

use Yii;
use app\models\DailyNotes;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

/**
 * DailyNotesController реализует действия CRUD для модели DailyNotes.
 */
class DailyNotesController extends Controller
{
    /**
     * Показывает список всех моделей DailyNotes.
     *
     * @return string
     */
    public function actionIndex()
{
    // Получаем текущего пользователя
    $user = Yii::$app->user->identity;

    // Получаем текущую дату
    $currentDate = date('Y-m-d');

    // Проверяем роль пользователя
    if ($user->role_id == 2) {
        // Если роль пользователя равна 2 (администратор), отображаем все цитаты
        $dataProvider = new ActiveDataProvider([
            'query' => DailyNotes::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    } else {
        // Если роль пользователя не равна 2 (например, обычный пользователь), получаем цитату для текущего дня
        $model = DailyNotes::find()->where(['hobbie_id' => $user->hobbie_id, 'date' => $currentDate])->one();
        
        // Если цитата для текущего дня не найдена, создаем новую
        if ($model === null) {
            $model = new DailyNotes();
            $model->hobbie_id = $user->hobbie_id;
            $model->date = $currentDate;
            // Здесь можно добавить логику для выбора новой цитаты или создания случайной цитаты
            // Например:
            // $randomQuote = $this->getRandomQuote();
            // $model->quote = $randomQuote;
            $model->save();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}


    /**
     * Создает новую модель DailyNotes.
     * Если создание прошло успешно, браузер будет перенаправлен на страницу 'view'.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DailyNotes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model,'imageFile');
                if ($model->upload()){
                    return $this->redirect(['/daily-notes/index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Обновляет существующую модель DailyNotes.
     * Если обновление прошло успешно, браузер будет перенаправлен на страницу 'view'.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($this->request->isPost) {
        if ($model->load($this->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile'); // Загрузка нового изображения
            if ($model->imageFile) {
                // Если новое изображение было загружено, то выполните загрузку
                if ($model->upload()) {
                    // После успешной загрузки изображения выполните остальные действия
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                // Если изображение не было выбрано, просто сохраните модель без изменений изображения
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}


    /**
     * Отображает одну конкретную модель DailyNotes.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;

        // Проверяем, что пользователь имеет роль ID не равную 2 и что его хобби совпадает с хобби цитаты
        if ($user->role_id != 2 && $model->hobbie_id != $user->hobbie_id) {
            throw new ForbiddenHttpException('У вас нет доступа к этой странице.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Находит модель DailyNotes по ее первичному ключу.
     * Если модель не найдена, будет выброшено исключение HTTP 404.
     * @param int $id ID
     * @return DailyNotes загруженная модель
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    protected function findModel($id)
    {
        if (($model = DailyNotes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не существует.');
    }
}
