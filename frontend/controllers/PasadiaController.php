<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Pasadia;
use frontend\models\PasadiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\PasadiaServicio;

/**
 * PasadiaController implements the CRUD actions for Pasadia model.
 */
class PasadiaController extends Controller {

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
     * Lists all Pasadia models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PasadiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pasadia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pasadia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Pasadia();

        if ($model->load(Yii::$app->request->post())) {
            $model->estado = 0;
            $model->agencia = Yii::$app->request->post('pasadia-agencia');
            $model->obs = Yii::$app->request->post('Pasadia[obs]');



            $fe = explode('-', $model->fecha);
            $model->fecha = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

            if ($model->save()) {
//                return $this->redirect(['index']);
                return $this->redirect(['servicio', 'id' => $model->id]);
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

    public function actionInfo() {
        $id = Yii::$app->request->get('id');
        $pdia = Pasadia::findOne(['id' => $id]);

        return $this->render('info', [
                    'model' => $pdia,
        ]);
    }

    function actionDeleteser() {
        $id = Yii::$app->request->get('id');
        $pasa = Yii::$app->request->get('pasa');
        $pdia = Pasadia::findOne(['id' => $pasa]);
        
        PasadiaServicio::findOne(['id' => $id])->delete();
        Yii::$app->session->setFlash('success', 'El servicio del pasadia se ha eliminado correctamente');

        return $this->render('info', [
                    'model' => $pdia,
        ]);
    }

    public function actionServicio() {
        $pasadia = $this->findModel(Yii::$app->request->get('id'));

        return $this->render('servicio', [
                    'model' => $pasadia,
        ]);
    }

    /**
     * Updates an existing Pasadia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);

        $fe = explode('-', $model->fecha);
        $model->fecha = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

        if ($model->load(Yii::$app->request->post())) {
            $fe = explode('-', $model->fecha);
            $model->fecha = $fe[2] . '-' . $fe[1] . '-' . $fe[0];
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    function actionAdd() {
        $pasadia = new PasadiaServicio();

        $pasadia->pasadia = Yii::$app->request->post('id_pasadia');
        $pasadia->servicio = Yii::$app->request->post('pasadia_sub');
        $pasadia->precio = Yii::$app->request->post('pasadia_impb');
        $pasadia->cant = Yii::$app->request->post('pasadia_cant');
        $incluir = Yii::$app->request->post('pasa_incl');
        $ingreso = Yii::$app->request->post('pasa_ingreso');

        $pasadia->incluir = 0;
        if ($ingreso == 1) {
            $pasadia->incluir = 2;
        }

        if ($incluir == 1) {
            $pasadia->incluir = 1;
        }

        if ($pasadia->save()) {
            Yii::$app->session->setFlash('success', 'El servicio del pasadia se ha creado correctamente');
            $pasa = $this->findModel(Yii::$app->request->post('id_pasadia'));

            return $this->redirect(['servicio',
                        'id' => Yii::$app->request->post('id_pasadia'),
                        'model' => $pasa,
            ]);
        }
    }

    function actionCalendario() {
        return $this->render('calendario');
    }

    /**
     * Deletes an existing Pasadia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pasadia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pasadia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Pasadia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
