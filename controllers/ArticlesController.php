<?php

namespace app\controllers;
use Yii;
use app\models\Articles;
use app\models\ArticlesSearch;
use app\models\FavoriteArticles;
use app\models\Rating;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Articles models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articles model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Articles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Articles();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model,'imageFile');
                if ($model->upload()){
                    return $this->redirect(['/articles/index']);
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
     * Updates an existing Articles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
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
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


        ###########################################
        ##########                     ############
        ##########   ИЗБРАННОЕ         ############
        ##########                     ############
        ###########################################

        // Действие для отображения избранных рецептов
        public function actionFavorites()
        {
            // Получаем список избранных рецептов для текущего пользователя
            $userId = Yii::$app->user->id;
            $favorites = FavoriteArticles::find()->where(['user_id' => $userId])->all();

            return $this->render('favorites', [
                'favorites' => $favorites,
            ]);
        }

        // Действие для добавления рецепта в избранное
        public function actionAddToFavorites($article_id)
        {
            // Проверяем, что пользователь авторизован
            if (!Yii::$app->user->isGuest) {
                // Создаем новую запись в таблице Favorite
                $favorite = new FavoriteArticles();
                $favorite->user_id = Yii::$app->user->id; // ID текущего пользователя
                $favorite->article_id = $article_id; // ID статьи, который добавляется в избранное
                $favorite->save();
    
                // Можно также добавить проверку на успешное сохранение
                // и соответствующую обработку ошибок, если необходимо
    
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                // Пользователь не авторизован, можно сделать редирект на страницу авторизации или отобразить сообщение об ошибке
                Yii::$app->session->setFlash('error', 'Вы должны быть авторизованы, чтобы добавлять статьи в избранное.');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        
        // Действие для удаления рецепта из избранного
        public function actionRemoveFromFavorites($article_id)
        {
            // Проверяем, что пользователь авторизован
            if (!Yii::$app->user->isGuest) {
                // Находим запись в таблице Favorite для текущего пользователя и указанного рецепта
                $favorite = FavoriteArticles::findOne(['user_id' => Yii::$app->user->id, 'article_id' => $article_id]);
                if ($favorite !== null) {
                    // Если запись найдена, удаляем ее
                    $favorite->delete();
                }
    
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                // Пользователь не авторизован, можно сделать редирект на страницу авторизации или отобразить сообщение об ошибке
                Yii::$app->session->setFlash('error', 'Вы должны быть авторизованы, чтобы удалять статьи из избранного.');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }


        ###########################################
        ##########                     ############
        ##########   РЕЙТИНГ ДНЯ       ############
        ##########                     ############
        ###########################################
    public function actionRate($id)
    {
        // Находим модель рецепта
        $article = $this->findModel($id);
        
        // Получаем текущего пользователя
        $userId = Yii::$app->user->id;
    
        // Находим запись в таблице Rating для текущего пользователя и рецепта
        $ratingModel = Rating::findOne(['user_id' => $userId, 'article_id' => $article->id]);
    
        // Если запись уже существует, обновляем ее
        if ($ratingModel === null) {
            $ratingModel = new Rating();
            $ratingModel->user_id = $userId;
            $ratingModel->article_id = $article->id;
        }
    
        // Если данные отправлены методом POST и успешно загружены в модель рейтинга
        if ($ratingModel->load(Yii::$app->request->post())) {
            // Удаляем существующую запись, чтобы учитывалась только новая оценка
            if ($ratingModel->id !== null) {
                $ratingModel->delete();
            }
    
            // Валидируем и сохраняем модель рейтинга
            if ($ratingModel->save()) {
                Yii::$app->session->setFlash('success', 'Статья успешно оценена.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении оценки статьи.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при загрузке данных формы.');
        }
    
        // Возвращаем пользователя на страницу просмотра рецепта
        return $this->redirect(['view', 'id' => $article->id]);
    }


}
