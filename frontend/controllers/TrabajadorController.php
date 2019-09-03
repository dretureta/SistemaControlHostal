<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Trabajador;
use frontend\models\TrabajadorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\TrabFunciones;
use frontend\models\DptoFunciones;
use frontend\models\Funciones;
use frontend\models\Addgastos;

/**
 * TrabajadorController implements the CRUD actions for Trabajador model.
 */
class TrabajadorController extends Controller {

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

    public function actionInfo() {
        $id = Yii::$app->request->get('id');
        return $this->render('info', [
                    'id' => $id,
        ]);
    }

    public function actionDeletefun() {
        $id = Yii::$app->request->get('id');
        $trab = Yii::$app->request->get('trab');
        $del = TrabFunciones::find()->where(['id' => $id])->all();

        if ($del[0]->estado = 1) {

            $id_gastos = $del[0]->trab0->dpto0->gastos;

            $fecha = $del[0]->fecha;
            $imp = $del[0]->cantidad * $del[0]->precio;

            $list_gastos = Addgastos::find()->where(['gastos' => $id_gastos])->andWhere(['fecha' => $fecha])->all();

           
           //$list_gastos[0]->importe-=$imp;
            $list_gastos[0]->delete();
        }
        $del[0]->delete();
        Yii::$app->session->setFlash('success', 'Las función se ha eliminado correctamente');
        return $this->redirect(['info',
                    'id' => $trab
        ]);
    }

    /**
     * Lists all Trabajador models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrabajadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trabajador model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Trabajador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Trabajador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Trabajador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /* metodo para mostrar el trabajador y sus funciones */

    public function actionFunciones($id) {

        //$trab = Trabajador::findAll(['id' => $id]);
//
//        $dpto = DptoFunciones::findAll(['dpto' => $trab[0]->dpto]);
//
//        $cont_trab = 0;
//        $func = TrabFunciones::find()->where(['trab' => $id])->andWhere(['estado' => 0])->all();
//        for ($i = 0; $i < count($func); $i++) {
//            $cont_trab+=$func[$i]->precio * $func[$i]->cantidad;
//        }
        //return $this->redirect(['funciones','id'=>$id]);
        return $this->render('funciones', [
                    'id' => $id
        ]);
    }

    public function actionAddfunciones() {
        $id = Yii::$app->request->post('id');
        $fecha = Yii::$app->request->post('fecha_func');

        $id_func = Yii::$app->request->post('id_func');
        $cant = Yii::$app->request->post('cant');
        $precio = Yii::$app->request->post('precio');

        $fe_en = explode('-', $fecha);
        $fecha = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

        $add = new TrabFunciones();
        $add->trab = $id;
        $add->func = $id_func;
        $add->cantidad = $cant;
        $add->precio = $precio;
        $add->fecha = $fecha;
        $add->estado = 0;

        if ($add->save()) {
            Yii::$app->session->setFlash('success', 'Las función se ha adicionado correctamente');
            return $this->redirect(['funciones',
                        'id' => $id
            ]);
        }
        Yii::$app->session->setFlash('success', 'Las función se no se ha creado');
        return $this->redirect(['funciones',
                    'id' => $id
        ]);

//        $trab = Trabajador::findAll(['id' => $id]);
//
//        $dpto = DptoFunciones::findAll(['dpto' => $trab[0]->dpto]);
//
//        $cont_trab = 0;
//        $func = TrabFunciones::find()->where(['trab' => $id])->andWhere(['estado' => 0])->all();
//        for ($i = 0; $i < count($func); $i++) {
//            $cont_trab+=$func[$i]->precio * $func[$i]->cantidad;
//        }
//        return $this->render('funciones', [
//                    'model' => $trab,
//                    'salario' => $cont_trab,
//                    'dpto' => $dpto,
//        ]);
    }

    public function actionDefunciones() {
        $id = Yii::$app->request->get('trab');
        $fecha = Yii::$app->request->get('fecha');
        $id_func = Yii::$app->request->get('id');



        $fe = $fecha[0] . '-' . $fecha[1] . '-' . $fecha[2];

        $del = TrabFunciones::find()->where(['trab' => $id])->andWhere(['fecha' => $fecha])->andWhere(['func' => $id_func])->all();

        $gasto = $del[0]->trab0->dpto0->gastos;



        $imp = 0;
        for ($i = 0; $i < count($del); $i++) {
            $imp+=$del[$i]->cantidad * $del[$i]->precio;
            $del[$i]->delete();
        }


        $list_gastos = Addgastos::find()->where(['gastos' => $gasto])->andWhere(['fecha' => $fecha])->andWhere(['importe' => $imp])->all();

        if (count($list_gastos) != 0) {
            $list_gastos[0]->delete();
        }



        $id_trab = Yii::$app->request->get('trab');

//        $trab = Trabajador::findAll(['id' => $id_trab]);
//
//        $dpto = DptoFunciones::findAll(['dpto' => $trab[0]->dpto]);
//
//        $cont_trab = 0;
//        $func = TrabFunciones::find()->where(['trab' => $id_trab])->andWhere(['estado' => 0])->all();
//        for ($i = 0; $i < count($func); $i++) {
//            $cont_trab+=$func[$i]->precio * $func[$i]->cantidad;
//        }
        Yii::$app->session->setFlash('success', 'Las funciones se ha eliminado correctamente');
//        return $this->render('funciones', [
//                    'model' => $trab,
//                    'salario' => $cont_trab,
//                    'dpto' => $dpto,
//        ]);

        return $this->redirect(['funciones',
                    'id' => $id_trab
        ]);
    }

    public function actionPagado() {
        $id = Yii::$app->request->get('id');

        $fecha_act = date("Y-m");

        $mod_date1 = strtotime($fecha_act . "- 1 month");
        $fecha_ant = date("Y-m", $mod_date1);



        $pagado = TrabFunciones::find()->where(['trab' => $id])->andWhere(['estado' => 0])->all();
        $pagado2 = TrabFunciones::find()->where(['trab' => $id])->andWhere(['estado' => 0])->all();

        $salrio = 0;
        $salrio2 = 0;

        for ($i = 0; $i < count($pagado); $i++) {
            $pagado[$i]->estado = 1;
            $pagado[$i]->save();
            $salrio+=$pagado[$i]->cantidad * $pagado[$i]->precio;
        }
        for ($i = 0; $i < count($pagado2); $i++) {
            $pagado2[$i]->estado = 1;
            $pagado2[$i]->save();
            $salrio2=$pagado2[$i]->cantidad * $pagado2[$i]->precio;


            $trab = Trabajador::findAll(['id' => $id]);
            //print_r(count($pagado));die;
            $gastos = new Addgastos();
//            $gastos2 = new Addgastos();

            $gastos->gastos = $trab[0]->dpto0->gastos;
            $gastos->cant = 1;
            $gastos->importe = $salrio2;
            $gastos->fecha = $pagado2[$i]->fecha;
            $gastos->unidad = 1;
            $gastos->save();
        }


//        $gastos->gastos = $trab[0]->dpto0->gastos;
//        $gastos->cant = 1;
//        $gastos->importe = $salrio;
//        $gastos->fecha = date('Y-m-d');
//        $gastos->unidad = 1;
//        $gastos->save();
//        $gastos2->gastos = $trab[0]->dpto0->gastos;
//        $gastos2->cant = 1;
//        $gastos2->importe = $salrio2;
//        $gastos2->fecha = $fecha_ant."-15";
//        $gastos2->unidad = 1;
//        $gastos2->save();

        Yii::$app->session->setFlash('success', 'El pago se ha realizado correctamente');
        return $this->redirect(['funciones',
                    'id' => $id
        ]);
    }

    public function actionPrecio() {
        $func = Yii::$app->request->get('id');
        $funciones = Funciones::find()->where(['id' => $func])->all();
        echo json_encode($funciones[0]->precio);
    }

    /**
     * Deletes an existing Trabajador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trabajador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trabajador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Trabajador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
