<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Habitacion;
use frontend\models\HabitacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Ocupacion;
use frontend\models\OcupacionHab;

/**
 * HabitacionController implements the CRUD actions for Habitacion model.
 */
class HabitacionController extends Controller {

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
     * Lists all Habitacion models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new HabitacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Habitacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Habitacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Habitacion();



        if ($model->load(Yii::$app->request->post())) {

            $ocupacion = Ocupacion::find()->orderBy("id ASC")->all();

            $cont = 0;

            for ($i = 0; $i < count($ocupacion); $i++) {
                if ($ocupacion[$i]->id == Yii::$app->request->post($ocupacion[$i]->id)) {
                    if (Yii::$app->request->post($ocupacion[$i]->id . 'ocupacion_precio') != "") {

                        if ($cont == 0) {
                            $model->codigo=0;
                            $model->save();
                        }
                        $ocuphab = new OcupacionHab();
                        $ocuphab->hab = $model->id;
                        $ocuphab->ocupacion = $ocupacion[$i]->id;
                        $ocuphab->precio = Yii::$app->request->post($ocupacion[$i]->id . 'ocupacion_precio');
                        $ocuphab->save();
                        $cont++;
                    }
                }
            }

            if ($cont == 0) {
                Yii::$app->session->setFlash('error', 'Complete la habitación');
                return $this->render('create', [
                            'model' => $model,
                ]);
            }


            Yii::$app->session->setFlash('success', 'La habitación se ha creado correctamente');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Habitacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $ocupacion = Ocupacion::find()->orderBy("id ASC")->all();

            $cont = 0;

            for ($i = 0; $i < count($ocupacion); $i++) {
                if ($ocupacion[$i]->id == Yii::$app->request->post($ocupacion[$i]->id)) {
                    if (Yii::$app->request->post($ocupacion[$i]->id . 'ocupacion_precio') != "") {

                        if ($cont == 0) {
                            OcupacionHab::deleteAll(['hab' => $id]);
                        }
                        $ocuphab = new OcupacionHab();
                        $ocuphab->hab = $model->id;
                        $ocuphab->ocupacion = $ocupacion[$i]->id;
                        $ocuphab->precio = Yii::$app->request->post($ocupacion[$i]->id . 'ocupacion_precio');
                        $ocuphab->save();
                        $cont++;
                    }
                }
            }

            Yii::$app->session->setFlash('success', 'La habitación se ha actualizado correctamente');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Habitacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $model->codigo=1;
        $model->save();
        Yii::$app->session->setFlash('success', 'La habitación se ha eliminado correctamente');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Habitacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Habitacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Habitacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
