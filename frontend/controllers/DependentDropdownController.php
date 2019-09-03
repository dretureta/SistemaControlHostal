<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\HtmlHelpers;
use frontend\models\OcupacionHab;

class DependentDropdownController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionOcupacion($id) {
        $unidad = OcupacionHab::find()->where(['ocupacion' => $id])->all();
        for ($i = 0; $i < count($unidad); $i++) {
            $response[] = array(
                'id' => $unidad[$i]->id,
                'desc' => $unidad[$i]->hab0->nombre
            );
        }


        echo json_encode($response);
    }

    public function actionOcup($id) {
        echo HtmlHelpers::dropDownList(OcupacionHab::className(), 'ocupacion', $id, 'id', 'nombre');
    }

}
