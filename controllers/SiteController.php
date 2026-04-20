<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\helpers\FileHelper;
use yii\web\ForbiddenHttpException;

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
        $absPath = Yii::getAlias('@webroot/assets/tup');
        $relativeUrl = Yii::getAlias('@web/assets/tup');

        $items = [];

        if (is_dir($absPath)) {
            $files = FileHelper::findFiles($absPath, [
                'only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.webp'],
                'recursive' => false,
            ]);

            foreach ($files as $file) {
                $fileName = basename($file);
                $items[] = [
                    'content' => '<img src="' . $relativeUrl . '/' . $fileName . '" class="d-block w-100" style="height:800px; object-fit:cover;" />',
                ];
            }
        }

        return $this->render('index', ['items' => $items, 'relativeUrl' => $relativeUrl]);
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
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Create first user action. Only accessible when the users table is empty.
     *
     * @return Response|string
     * @throws ForbiddenHttpException if the users table is not empty
     */
    public function actionCreateFirstUser()
    {
        if (User::find()->exists()) {
            throw new ForbiddenHttpException('This page is only accessible when there are no users.');
        }

        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'User created successfully. You can now log in.');
                return $this->redirect(['/site/login']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create-first-user', [
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
}
