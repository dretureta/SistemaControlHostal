<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Servicio;
use frontend\models\ServicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Subservicios;

/**
 * ServicioController implements the CRUD actions for Servicio model.
 */
class ServicioController extends Controller {

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
     * Lists all Servicio models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ServicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Servicio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView() {
        $nombre = Yii::$app->request->get('nom');
        $prioridad = Yii::$app->request->get('pri');
        Yii::$app->session->setFlash('error', 'Existe un servicio con esa prioridad desea reemplazarlo');
        return $this->render('view', [
                    'nom' => $nombre,
                    'pri' => $prioridad
        ]);
    }

    /**
     * Creates a new Servicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Servicio();

        if ($model->load(Yii::$app->request->post())) {
            $prioridad = Servicio::find()->where(['prioridad' => $model->prioridad])->all();
            if (count($prioridad) != 0) {
                Yii::$app->session->setFlash('error', 'Existe un servicio con esa prioridad desea reemplazarlo');

                return $this->redirect(['view', 'nom' => $model->nombre, 'pri' => $model->prioridad, 'ingles' => $model->ingles, 'frances' => $model->frances]);
            }
            
            $lis_servicio=  Servicio::find()->orderBy('prioridad desc')->all();
           

            $num = $lis_servicio[0]->prioridad + 1;
            
            if ($model->prioridad > $num) {
                 Yii::$app->session->setFlash('error', 'Por favor la prioridad para el nuevo servicio debe ser :'.$num);
                return $this->render('create', [
                            'model' => $model,
                ]);
            }

            $model->estado=0;
            $model->save();
            Yii::$app->session->setFlash('success', 'El servicio se ha creado correctamente');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionSub() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->render('sub', ['id' => $model]);
    }

    public function actionAdd() {
        $model = new Subservicios();

        if ($model->load(Yii::$app->request->post())) {
            $id = $model->servicio;
            $serv = Servicio::findOne($id);
            $model->fecha = date('yy-m-d');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'El subservicio se ha creado correctamente');
                return $this->render('sub', ['id' => $serv]);
            } else {
                return $this->render('sub', ['id' => $serv]);
            }
        }
    }

    public function actionPrioridad() {
        $model = new Servicio();
        if ($model->load(Yii::$app->request->post())) {
            
            $prioridad = $model->prioridad-1;
           
            $connection = \Yii::$app->db;
            $connection->open();
            
            $command = $connection->createCommand('select * from servicio where prioridad >:prioridad order by prioridad asc');
            $command->bindParam(':prioridad', $prioridad); 
            $result = $command->queryAll();
            $connection->close();
            
//            $ser = new Servicio();

            for ($i = 0; $i < count($result); $i++) {  
                $id=$result[$i]['id'];                
                $ser = Servicio::find()->where(['id' =>$id])->all();
                $ser[0]->prioridad+=1;
                $ser[0]->save();
            }

            $model->save();

            Yii::$app->session->setFlash('success', 'Se ha creado el servicio y actualizado la prioridad');
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Servicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El servicio se ha actualizado correctamente');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Servicio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $id = Yii::$app->request->get('id');
        $serv=Servicio::find()->where(['id' => $id])->all();
        $serv[0]->estado=1;
        $serv[0]->save();
        
       
        Yii::$app->session->setFlash('success', 'El servicio se ha eliminado correctamente');
        return $this->redirect(['index']);
    }

    public function actionDelete_sub() {
        $id = Yii::$app->request->get('id');
        $serv = Yii::$app->request->get('serv');
        $subserv=Subservicios::find()->where(['id' => $id])->all();
        $subserv[0]->estado=1;
        $subserv[0]->save();
        Yii::$app->session->setFlash('success', 'El subservicio del servicio se ha eliminado correctamente');

        return $this->redirect(['sub',
                    'id' => $serv
        ]);
    }

    /**
     * Finds the Servicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Servicio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
