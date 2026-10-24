<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Html;

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
        $imageBaseUrl = rtrim(IMAGE_BASE_URL, '/');
        // IMAGE_BASE_URL may already include /html (as in the local default).
        $imageBaseUrl = preg_replace('~/html$~i', '', $imageBaseUrl);
        $imageDirectoryUrl = $imageBaseUrl . '/html/images/tup';
        $fileNames = [
            'tup folosit.jpeg',
            'tup intors.jpeg',
            'tup mov.jpeg',
            'tup roz.jpeg',
            'tup 3d.jpeg',
        ];
        $items = [];

        foreach ($fileNames as $fileName) {
            $imageUrl = $imageDirectoryUrl . '/' . rawurlencode($fileName);
            $items[] = [
                'content' => Html::img($imageUrl, [
                    'alt' => pathinfo($fileName, PATHINFO_FILENAME),
                    'class' => 'd-block w-100',
                    'style' => 'height:800px; object-fit:cover;',
                ]),
            ];
        }

        return $this->render('index', ['items' => $items, 'relativeUrl' => $imageDirectoryUrl]);
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
