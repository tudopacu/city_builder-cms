<?php

namespace app\modules\age\controllers;

use app\controllers\BaseController;
use app\models\Age;
use app\models\AgeSearch;
use Yii;
use yii\db\IntegrityException;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageController implements the CRUD actions for Age model.
 */
class ManageController extends BaseController
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
     * Lists all Age models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AgeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Age model.
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
     * Creates a new Age model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Age();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $this->clearAgeCaches();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
            $model->sort_order = Age::getNextSortOrder();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Age model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $this->clearAgeCaches();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Age model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        try {
            $model->delete();
        } catch (IntegrityException $e) {
            Yii::$app->session->setFlash('error', 'Age "' . Html::encode($model->name) . '" is still used by buildings, items or road types. Reassign them before deleting it.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->clearAgeCaches();

        return $this->redirect(['index']);
    }

    /**
     * Clears API caches that can embed age data: the age list itself and the item/building catalogs.
     */
    protected function clearAgeCaches(): void
    {
        foreach (['age', 'item', 'building'] as $prefix) {
            $this->deleteRedisKeysByPrefix($prefix);
        }
    }

    /**
     * Finds the Age model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Age the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Age::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
