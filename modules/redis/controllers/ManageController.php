<?php

namespace app\modules\redis\controllers;

use app\models\RedisKey;
use app\models\RedisKeySearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageController implements the CRUD actions for RedisKey model.
 */
class ManageController extends Controller
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
                        'purge'  => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Redis keys.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel  = new RedisKeySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RedisKey model.
     *
     * @param string $key
     * @return string
     * @throws NotFoundHttpException if the key cannot be found
     */
    public function actionView($key)
    {
        return $this->render('view', [
            'model' => $this->findModel($key),
        ]);
    }

    /**
     * Creates a new RedisKey.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RedisKey();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'key' => $model->key]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RedisKey.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $key
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the key cannot be found
     */
    public function actionUpdate($key)
    {
        $model = $this->findModel($key);

        if ($this->request->isPost && $model->load($this->request->post())) {
            // Prevent key renaming via form manipulation
            $model->key = $key;
            if ($model->save()) {
                return $this->redirect(['view', 'key' => $model->key]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RedisKey.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $key
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the key cannot be found
     */
    public function actionDelete($key)
    {
        $this->findModel($key)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Purges (flushes) all keys from the current Redis database.
     *
     * @return \yii\web\Response
     */
    public function actionPurge()
    {
        Yii::$app->redis->flushdb();
        Yii::$app->session->setFlash('success', 'All Redis keys have been purged.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the RedisKey model based on its key name.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $key
     * @return RedisKey the loaded model
     * @throws NotFoundHttpException if the key cannot be found
     */
    protected function findModel($key)
    {
        if (($model = RedisKey::findOne($key)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested key does not exist.');
    }
}
