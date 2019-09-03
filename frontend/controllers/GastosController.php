<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Gastos;
use frontend\models\GastosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Addgastos;

/**
 * GastosController implements the CRUD actions for Gastos model.
 */
class GastosController extends Controller {

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
     * Lists all Gastos models.
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Displays a single Gastos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Gastos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Gastos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El gasto se ha creado correctamente');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionGastos() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->render('gastos', ['id' => $model]);
    }

    public function actionAdicionar() {
        $model = new Addgastos();

        if ($model->load(Yii::$app->request->post())) {
            $id = $model->gastos;
            $gas = Gastos::findOne($id);
            $fe_en = explode('-', $model->fecha);
            $model->fecha = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

            $gast = Addgastos::find()
                    ->where(["gastos" => $id])
                    ->andwhere(["unidad" => $model->unidad])
                    ->andwhere(["fecha" => $model->fecha])
                    ->all();
           
            if (count($gast) > 0) {
                $gast[0]->cant+=$model->cant;
                $gast[0]->importe+=$model->importe;
                if ($gast[0]->save()) {
                    Yii::$app->session->setFlash('success', 'El gasto se ha creado correctamente');
                    return $this->redirect(['gastos', 'id' => $id]);
                }
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'El gasto se ha creado correctamente');
                return $this->redirect(['gastos', 'id' => $gas->id]);
            } else {
                return $this->redirect(['gastos', 'id' => $gas->id]);
            }
        }
    }

    public function actionDeleteaddgas() {
        $gastos = Yii::$app->request->get('id');
        $id = Yii::$app->request->get('gas');
        Addgastos::deleteAll(['id' => $id]);
        Yii::$app->session->setFlash('success', 'El gasto se ha eliminado correctamente');
        return $this->redirect(['gastos', 'id' => $gastos]);
    }

    /**
     * Updates an existing Gastos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El gasto se ha actualizado correctamente');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gastos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'El gasto se ha eliminado correctamente');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Gastos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gastos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Gastos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
