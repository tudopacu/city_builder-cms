<?php

namespace app\modules\building\controllers;

use app\models\BuildingCurrentProduction;
use app\models\BuildingCurrentProductionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BuildingCurrentProductionController implements the CRUD actions for BuildingCurrentProduction model.
 */
class BuildingCurrentProductionController extends Controller
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
     * Lists all BuildingCurrentProduction models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BuildingCurrentProductionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BuildingCurrentProduction model.
     * @param int $player_id Player ID
     * @param int $player_building_id Player Building ID
     * @param int $building_production_id Building Production ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($player_id, $player_building_id, $building_production_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($player_id, $player_building_id, $building_production_id),
        ]);
    }

    /**
     * Creates a new BuildingCurrentProduction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new BuildingCurrentProduction();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect([
                    'view',
                    'player_id' => $model->player_id,
                    'player_building_id' => $model->player_building_id,
                    'building_production_id' => $model->building_production_id,
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BuildingCurrentProduction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $player_id Player ID
     * @param int $player_building_id Player Building ID
     * @param int $building_production_id Building Production ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($player_id, $player_building_id, $building_production_id)
    {
        $model = $this->findModel($player_id, $player_building_id, $building_production_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect([
                'view',
                'player_id' => $model->player_id,
                'player_building_id' => $model->player_building_id,
                'building_production_id' => $model->building_production_id,
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BuildingCurrentProduction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $player_id Player ID
     * @param int $player_building_id Player Building ID
     * @param int $building_production_id Building Production ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($player_id, $player_building_id, $building_production_id)
    {
        $this->findModel($player_id, $player_building_id, $building_production_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BuildingCurrentProduction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $player_id Player ID
     * @param int $player_building_id Player Building ID
     * @param int $building_production_id Building Production ID
     * @return BuildingCurrentProduction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($player_id, $player_building_id, $building_production_id)
    {
        if (($model = BuildingCurrentProduction::findOne([
            'player_id' => $player_id,
            'player_building_id' => $player_building_id,
            'building_production_id' => $building_production_id,
        ])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
