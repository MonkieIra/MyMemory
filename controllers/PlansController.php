<?php

namespace app\controllers;

use Yii;
use app\models\Plans;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;

/**
 * PlansController implements the CRUD actions for Plans model.
 */
class PlansController extends Controller
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
     * Lists all Plans models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Plans::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->identity->id;
            $dataProvider->query->andWhere(['user_id' => $userId]);
        } else {
            // Если пользователь гость, то можете принять соответствующие меры, например, перенаправить на страницу входа
            // Yii::$app->response->redirect(['site/login'])->send();
            // Yii::$app->end();
        }

        $dataProvider->query->andWhere(['>=', 'date', new Expression('CURDATE()')]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Plans model.
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
     * Creates a new Plans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Plans();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Plans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Plans model.
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
     * Finds the Plans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Plans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Plans::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPreviousPlans()
{
    $dataProvider = new ActiveDataProvider([
        'query' => Plans::find(),
        /*
        'pagination' => [
            'pageSize' => 50
        ],
        'sort' => [
            'defaultOrder' => [
                'id' => SORT_DESC,
            ]
        ],
        */
    ]);

    if (!Yii::$app->user->isGuest) {
        $userId = Yii::$app->user->identity->id;
        $dataProvider->query->andWhere(['user_id' => $userId]);
    } else {
        // Если пользователь гость, то можете принять соответствующие меры, например, перенаправить на страницу входа
        // Yii::$app->response->redirect(['site/login'])->send();
        // Yii::$app->end();
    }

    // Добавляем условие для вывода предыдущих планов
    $dataProvider->query->andWhere(['<', 'date', new Expression('CURDATE()')]);
    
    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}
}
