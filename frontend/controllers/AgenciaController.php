<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Agencia;
use frontend\models\AgenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgenciaController implements the CRUD actions for Agencia model.
 */
class AgenciaController extends Controller {

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
     * Lists all Agencia models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AgenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agencia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Agencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Agencia();   

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'La agencia se ha creado correctamente');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }
    
    public function actionAlojamiento(){
         $id = Yii::$app->request->get('id');
         
         $agen=$this->findModel($id);
         //print_r($agen->nombre);die;
         

        if ($agen->nombre=="DIRECTA") {            
            $response["status"] = 'Si';
        } else {
            $response["status"] = 'No';
        }

        echo json_encode($response);
    }

    /**
     * Updates an existing Agencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);

        $pago = Yii::$app->request->post('pago');
        if ($pago == 1) {
            $model->pago = 1;
        } else {
            $model->pago = 0;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'La agencia se ha actualizado correctamente');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Agencia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $id = Yii::$app->request->get('id');
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'La agencia se ha eliminado correctamente');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Agencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Agencia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
