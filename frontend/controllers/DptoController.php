<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Dpto;
use frontend\models\DptoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Funciones;
use frontend\models\DptoFunciones;
use frontend\models\Gastos;

/**
 * DptoController implements the CRUD actions for Dpto model.
 */
class DptoController extends Controller {

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
     * Lists all Dpto models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DptoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dpto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dpto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Dpto();

        if (Yii::$app->request->post('nombre') != '') {
            $nombre = Yii::$app->request->post('nombre');

            $func = Funciones::find()->orderBy('nombre asc')->all();
            $cont = 0;

            $dpto2 = Dpto::find()->where(['nombre' => $nombre])->all();

            if (count($dpto2) != 0) {
                Yii::$app->session->setFlash('success', 'El departamento ya se encuentra creado');
                return $this->render('create', [
                            'model' => $model,
                ]);
            } else {
                $gastos = new Gastos();
                $gastos->nombre = 'SALARIO ' . $nombre;

                if ($gastos->save()) {
                    $model->nombre = $nombre;
                    $model->gastos = $gastos->id;
                    $model->save();

                    $cont++;

                    for ($i = 0; $i < count($func); $i++) {
                        if ($func[$i]->id == Yii::$app->request->post($func[$i]->id)) {

                            $dpto = new DptoFunciones();
                            $dpto->dpto = $model->id;
                            $dpto->func = $func[$i]->id;
                            $dpto->precio = $func[$i]->precio;
                            $dpto->save();
                        }
                    }
                }
            }



            if ($cont != 0) {
                Yii::$app->session->setFlash('success', 'El departamento se ha creado correctamente');
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dpto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if (Yii::$app->request->post('nombre') != '') {
            $nombre = Yii::$app->request->post('nombre');

            $func = Funciones::find()->orderBy('nombre asc')->all();
            $cont = 0;


            $model->nombre = $nombre;
            $model->save();
            
            $gastos=  Gastos::find()->where(['id' => $model->gastos])->all();
            $gastos[0]->nombre='SALARIO ' . $nombre;
            $gastos[0]->save();
            
            

            for ($i = 0; $i < count($func); $i++) {
                if ($func[$i]->id == Yii::$app->request->post($func[$i]->id)) {
                    $cont++;
                    $dpto_fun = DptoFunciones::find()->where(['dpto' => $model->id])->andWhere(['func' => $func[$i]->id])->all();
                    if (count($dpto_fun) == 0) {

                        $dpto = new DptoFunciones();
                        $dpto->dpto = $model->id;
                        $dpto->func = $func[$i]->id;
                        $dpto->precio = $func[$i]->precio;
                        $dpto->save();
                    }
                }
            }

            if ($cont != 0) {
                Yii::$app->session->setFlash('success', 'El departamento se ha actualizado correctamente');
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Dpto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        
        
        $dptop=$this->findModel($id);
        $gastos=  Gastos::findAll(['id'=>$dptop->gastos]);        
        $gastos[0]->delete();
        $dptop->delete();
       
        
        Yii::$app->session->setFlash('success', 'El departamento se ha eliminado correctamente');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Dpto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dpto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Dpto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
