<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Subservicios;
use frontend\models\SubserviciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Servicio;

/**
 * SubserviciosController implements the CRUD actions for Subservicios model.
 */
class SubserviciosController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Subservicios models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SubserviciosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subservicios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Subservicios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Subservicios();        
        
        if ($model->load(Yii::$app->request->post())&& $model->save()) { 
            $model->estado=0;
            $ser=  Servicio::find()->where(['id'=>$model->id])->all();
            Yii::$app->session->setFlash('success', 'El subservicio del servicio se ha creado correctamente');
            return $this->redirect(['sub',
                    'id' => $model->servicio
        ]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subservicios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El subservicio del servicio se ha actualizado correctamente');
            return $this->redirect(['servicio/sub','id' => $model->servicio]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Subservicios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $id = Yii::$app->request->get('id');
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'El subservicio del servicio se ha eliminado correctamente');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Subservicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subservicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Subservicios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
