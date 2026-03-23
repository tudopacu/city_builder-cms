<?php

namespace app\modules\smartbill\controllers;

use app\models\Invoice;
use app\models\InvoiceSearch;
use app\models\Player;
use app\services\SmartbillService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageController implements the CRUD actions for Invoice model
 * and integrates with the Smartbill invoicing API.
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
                        'issue'  => ['POST'],
                        'cancel' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Invoice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoice model.
     *
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
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Invoice();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Invoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Invoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Issues an invoice via the Smartbill API.
     * Sets the invoice status to 'issued' and stores the Smartbill invoice number.
     *
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIssue($id)
    {
        $model = $this->findModel($id);

        if ($model->status !== Invoice::STATUS_DRAFT) {
            Yii::$app->session->setFlash('error', 'Only draft invoices can be issued.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $service = $this->getSmartbillService();
        $player  = $model->player;

        $result = $service->issueInvoice([
            'client' => [
                'name'    => $player->username ?? 'Player ' . $player->id,
                'email'   => $player->email ?? '',
                'address' => '',
            ],
            'products' => [
                [
                    'name'        => $model->description ?: 'City Builder CMS Service',
                    'quantity'    => 1,
                    'price'       => (float) $model->amount,
                    'vatName'     => 'Normala',
                    'isService'   => true,
                    'saveToDb'    => false,
                    'measuringUnitName' => 'buc',
                ],
            ],
            'description' => $model->description,
            'currency'    => $model->currency,
        ]);

        if ($result !== null && isset($result['number'])) {
            $model->status = Invoice::STATUS_ISSUED;
            $model->smartbill_invoice_number = $result['number'];
            $model->smartbill_series = $result['series'] ?? $service->series;
            $model->issued_at = date('Y-m-d H:i:s');
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Invoice issued successfully via Smartbill.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to issue invoice via Smartbill. Please check the logs.');
        }

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Cancels an issued invoice via the Smartbill API.
     *
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCancel($id)
    {
        $model = $this->findModel($id);

        if ($model->status !== Invoice::STATUS_ISSUED) {
            Yii::$app->session->setFlash('error', 'Only issued invoices can be cancelled.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $service = $this->getSmartbillService();

        $result = $service->cancelInvoice(
            $model->smartbill_series,
            $model->smartbill_invoice_number
        );

        if ($result !== null) {
            $model->status = Invoice::STATUS_CANCELLED;
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Invoice cancelled successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to cancel invoice via Smartbill. Please check the logs.');
        }

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Returns a configured SmartbillService instance.
     *
     * @return SmartbillService
     */
    protected function getSmartbillService()
    {
        $params = Yii::$app->params['smartbill'] ?? [];
        $service = new SmartbillService();
        $service->username = $params['username'] ?? '';
        $service->token    = $params['token'] ?? '';
        $service->cif      = $params['cif'] ?? '';
        $service->series   = $params['series'] ?? 'FCMS';
        return $service;
    }
}
