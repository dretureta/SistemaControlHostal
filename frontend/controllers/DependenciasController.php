<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Habitacion;
use frontend\models\Subservicios;

class DependenciasController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionHab($id) {
        $precio = Habitacion::find()->where(['id' => $id])->all();
        $pre = $precio[0]->precio;


        echo json_encode($pre);
    }

    public function actionSubservicios($id) {
        $precio = Subservicios::find()->where(['id' => $id])->all();
        $pre = $precio[0]->precio;

        echo json_encode($pre);
    }

    public function actionSub($id) {
        $sub = Subservicios::find()->where([ 'servicio' => $id])->andwhere([ 'estado' => 0])->orderby('nombre asc')->all();
        $response = array();
        for ($i = 0; $i < count($sub); $i++) {
            $response[$i] = array(
                'id' => $sub[$i]->id,
                'nombre' => $sub[$i]->nombre
            );
        }


        echo json_encode($response);
    }

}
