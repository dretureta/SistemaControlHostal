<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    public function behaviors() {
        /*  return [
          'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
          'delete' => ['get'],
          ],
          ],
          ]; */

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create'],
                'rules' => [

                    [
                        'actions' => ['create'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function Control() {
        //if (Yii::$app->user->identity->rol != 'Administrador') {
           // Yii::$app->user->logout();
            return $this->goHome();
       // }
    }

    public function actionIndex() {
        //$this->Control();
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        return $this->redirect(['site/usuarios']);

        /* $model = new User();
          $model->created_at = 'HDSFHSDHFSDHFDS44SDFSD4FDS54F';
          $model->auth_key = 'HDSFHSDHFSDHFDS44SDFSD4FDS54F';
          $model->status = 10;
          $model->updated_at = '10ASDKSAHDGHASJGDHJSAGHDS';

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['index']);
          } else {
          return $this->render('create', [
          'model' => $model,
          ]);
          } */
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {
        $id = $_GET['id'];
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $id = $_GET['id'];
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
