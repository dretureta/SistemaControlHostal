<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Reservacion;
use frontend\models\ReservacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\ReservacionServicios;
use frontend\models\Habitacion;
use frontend\models\ReservacionHab;
use frontend\models\ReservacionesDenegadas;
use frontend\models\Auxiliar;

/**
 * ReservacionController implements the CRUD actions for Reservacion model.
 */
class ReservacionController extends Controller {

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
     * Lists all Reservacion models.
     * @return mixed
     */
    function actionCheckout() {
        $id = Yii::$app->request->get('id');
        $check = $this->findModel($id);
        $check->estado = 2;
        $check->save();
        Yii::$app->session->setFlash('success', 'La reservación se ha check out correctamente');
        return $this->redirect(['index']);

//        return $this->redirect(['servicio',
//                    'id' => $check->id
////'hab' => $model1->hab
//        ]);
    }

    public function actionAddfecha() {
        $entrada = Yii::$app->request->get('fecha');
        $id_res = Yii::$app->request->get('res');
        $fecha_inicial = Yii::$app->request->get('inicial');
        $fecha_final = Yii::$app->request->get('final');
        $nombre = Yii::$app->request->get('nombre');

//        print_r($entrada);die;


        /** ESTO ES PARA SUMAR A UNA FECHA UN DIA */
        $fe_en = explode('-', $entrada);
        $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

        $mod_date1 = strtotime($entrada . "+ 1 days");
        $fe_salida = date("Y-m-d", $mod_date1);

        $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();
        $data = array();

        for ($k = 0; $k < count($hab); $k++) {
            $id_hab = $hab[$k]->id;



            $connection = \Yii::$app->db;
            $connection->open();

            $command = $connection->createCommand('SELECT reservacion.nombre_cliente FROM reservacion,reservacion_hab WHERE  (reservacion_hab.hab = :habitacion) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion.fecha_entrada <= :entrada1) AND (reservacion.fecha_salida > :salida1) AND (reservacion_hab.estado=0)  OR (reservacion.fecha_entrada <=:entrada2 ) AND (reservacion.fecha_salida >= :salida2) AND (reservacion.fecha_entrada > :entrada3 AND reservacion.fecha_entrada < :salida3) AND  (reservacion_hab.hab = :habitacion1)AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0) OR (reservacion.fecha_salida > :entrada4 AND reservacion.fecha_salida < :salida4) AND (reservacion_hab.hab = :habitacion2) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0)');
            $command->bindParam(':habitacion', $id_hab);
            $command->bindParam(':entrada1', $fecha_ent);
            $command->bindParam(':salida1', $fecha_ent);
            $command->bindParam(':entrada2', $fe_salida);
            $command->bindParam(':salida2', $fe_salida);
            $command->bindParam(':entrada3', $fecha_ent);
            $command->bindParam(':salida3', $fe_salida);
            $command->bindParam(':habitacion1', $id_hab);
            $command->bindParam(':entrada4', $fecha_ent);
            $command->bindParam(':salida4', $fe_salida);
            $command->bindParam(':habitacion2', $id_hab);
            $result = $command->queryAll();
            $connection->close();

            if (count($result) == 0) {
                if ($hab[$k]->nombre != 'ANEXO') {
                    $data[count($data)] = array(
                        'id' => $id_hab,
                        'nombre' => $hab[$k]->nombre,
                        'fecha_entrada' => $entrada,
                        'fecha_salida' => $fe_salida,
                    );
                }
            }
        }

        //print_r($data);die;

        return $this->render('reservacion', [
                    'model' => $data,
                    'reservacion' => $id_res,
                    'entrada' => $fecha_ent,
                    'salida' => $fe_salida,
                    'inicial' => $fecha_inicial,
                    'final' => $fecha_final,
                    'nombre' => $nombre,
        ]);
    }

    public function actionCrear() {


        $model = new Reservacion();
        $model->estado = 0;

        //echo Yii::$app->request->post('$hab[$i]->id');
        if ($model->load(Yii::$app->request->post())) {

            $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();


            $fecha_ent = Yii::$app->request->post('fe_entrada');
            $fecha_sal = Yii::$app->request->post('fe_salida');

            $inicial = Yii::$app->request->post('inicial2');
            $final = Yii::$app->request->post('final2');





            $start_ts = strtotime($inicial);
            $end_ts = strtotime($final);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400) - 1;

            $fecha = array();
            $fecha[count($fecha)] = $inicial;
            $inicial1 = $inicial;

            for ($i = 0; $i < $dif_dias; $i++) {
                $mod_date1 = strtotime($inicial1 . "+ 1 days");
                $inicial1 = date("d-m-Y", $mod_date1);
                $fecha[count($fecha)] = $inicial1;
            }





            $fe_en = explode('-', $fecha_ent);
            $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

            $fe_sa = explode('-', $fecha_sal);
            $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];



            $fe_inicial = explode('-', $inicial);
            $fecha_inicial = $fe_inicial[2] . '-' . $fe_inicial[1] . '-' . $fe_inicial[0];

            $fe_final = explode('-', $final);
            $fecha_final = $fe_final[2] . '-' . $fe_final[1] . '-' . $fe_final[0];



            $model->fecha_entrada = $fecha_inicial;
            $model->fecha_salida = $fecha_final;

            $cont = 0;



            for ($i = 0; $i < count($hab); $i++) {
                if ($hab[$i]->id == Yii::$app->request->post($hab[$i]->id)) {
                    $id_hab = $hab[$i]->id;


                    if (Yii::$app->request->post($hab[$i]->id . 'ocupacion') == "" || Yii::$app->request->post($hab[$i]->id . 'ocupacionprecio') == "") {
                        Yii::$app->session->setFlash('error', 'Por favor complete la habitación');
//                        $fecha_ent = $model->fecha_entrada;
//                        $fecha_sal = $model->fecha_salida;
//                        $fe_en = explode('-', $fecha_ent);
//                        $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];
//
//                        $fe_sa = explode('-', $fecha_sal);
//                        $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];
//
//
                        $model->fecha_entrada = $fecha_inicial;
                        $model->fecha_salida = $fecha_final;

                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                    }


                    $conj = Yii::$app->request->post('conjunto');
                    if ($conj == 1) {
                        $model->conjunto = 1;
                    } else {
                        $model->conjunto = 0;
                    }

                    if ($cont == 0) {
                        $model->save();
                        $cont++;
                    }

                    $res = new ReservacionHab();
                    $res->hab = $hab[$i]->id;
                    $res->ocupacion = Yii::$app->request->post($hab[$i]->id . 'ocupacion');
                    $res->precio = Yii::$app->request->post($hab[$i]->id . 'ocupacionprecio');
                    $res->reservacion = $model->id;
                    $res->fecha_entrada = $fecha_ent;
                    $res->fecha_salida = $fecha_sal;
                    $res->estado = 0;
                    $res->conjunto = $model->conjunto;
                    $res->agencia = $model->agencia;
                    $res->plan = $model->plan;
                    $res->save();

                    if (!$res->save()) {
                        $model->delete();
                        Yii::$app->session->setFlash('success', 'La reservacion no se ha creado');
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                    }
                }
            }

            if ($cont != 0) {
                /* Aqui enviarlo al update */
                Yii::$app->session->setFlash('success', 'Por favor complete la habitación');

//                $fe_en = explode('-', $model->fecha_entrada);
//                $model->fecha_entrada = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];
//
//                $fe_sa = explode('-', $model->fecha_salida);
//                $model->fecha_salida = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

                return $this->render('update', [
                            'model' => $model,
                            'data' => array(),
                            'rango' => $fecha,
                            'inicial' => $inicial,
                            'final' => $final,
                ]);
            } else {
                $fecha_ent = $model->fecha_entrada;
                $fecha_sal = $model->fecha_salida;


                $fe_en = explode('-', $fecha_ent);
                $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

                $fe_sa = explode('-', $fecha_sal);
                $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];


                $model->fecha_entrada = $fecha_ent;
                $model->fecha_salida = $fecha_sal;
                Yii::$app->session->setFlash('error', 'Por favor complete la habitación');
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('reservacion', [
                        'model' => $model,
            ]);
        }
    }

    public function actionActpers() {
        $id_res = Yii::$app->request->post('id_reservacion');
        $model = $this->findModel($id_res);

        $data = ReservacionHab::findAll(['reservacion' => $id_res]);

        $model->nombre_cliente = Yii::$app->request->post('nom_reservacion');

        $fecha_ent = Yii::$app->request->post('entcambiar');
        $fecha_sal = Yii::$app->request->post('salcambiar');
        $model->agencia = Yii::$app->request->post('agencia_res');
        $model->plan = Yii::$app->request->post('plan_res');
        $model->codigo = Yii::$app->request->post('codigo_res');
        $model->obs = Yii::$app->request->post('obs_res');


        $inicial = Yii::$app->request->post('inicial');
        $final = Yii::$app->request->post('final');

        $model->conjunto = 0;
        if (Yii::$app->request->post('conjunto') == 1) {
            $model->conjunto = 1;
        }

        $start_ts = strtotime($inicial);
        $end_ts = strtotime($final);
        $diferencia = $end_ts - $start_ts;
        $dif_dias = round($diferencia / 86400) - 1;

        $fecha = array();
        $fecha[count($fecha)] = $inicial;
        $inicial1 = $inicial;

        for ($i = 0; $i < $dif_dias; $i++) {
            $mod_date1 = strtotime($inicial1 . "+ 1 days");
            $inicial1 = date("d-m-Y", $mod_date1);
            $fecha[count($fecha)] = $inicial1;
        }


        $datos = array();
        for ($i = 0; $i < count($data); $i++) {
            $datos[count($datos)] = array(
                'id' => $data[$i]->hab,
                'nombre' => $data[$i]->hab0->nombre,
                'fecha_entrada' => $fecha_ent,
                'fecha_salida' => $fecha_sal,
            );
        }

        $fe_en = explode('-', $fecha_ent);
        $fe_sa = explode('-', $fecha_sal);



        $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();

        for ($i = 0; $i < count($hab); $i++) {
            if ($hab[$i]->id == Yii::$app->request->post($hab[$i]->id)) {

                if (Yii::$app->request->post('agencia_res') == 'Agencia') {
                    Yii::$app->session->setFlash('fecha', 'Por favor, el campo agencia no puede estar en blanco');
                    $aux = NULL;
                    $data = array();

                    return $this->render('update', [
                                'model' => $model,
                                'data' => array(),
                                'aux' => $aux,
                                'rango' => $fecha,
                                'inicial' => $inicial,
                                'final' => $final,
                    ]);
                }

                $reshab = ReservacionHab::find()->where(['hab' => $hab[$i]->id])->andWhere(['reservacion' => $model->id])->all();
                if (count($reshab) == 0) {
                    $res = new ReservacionHab();
                    $res->hab = $hab[$i]->id;
                    $res->ocupacion = Yii::$app->request->post($hab[$i]->id . 'ocupacion');
                    $res->precio = Yii::$app->request->post($hab[$i]->id . 'ocupacionprecio');
                    $res->reservacion = $model->id;
                    $res->fecha_entrada = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];
                    $res->fecha_salida = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];
                    $res->estado = 0;
                    $res->conjunto = $model->conjunto;
                    $res->agencia = $model->agencia;
                    $res->plan = $model->plan;
                    $res->save();

                    if (!$res->save()) {
                        $model->delete();
                        Yii::$app->session->setFlash('success', 'La reservacion no se ha creado');
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                    }
                }
            }
        }

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha adicionada la habitacion correctamente');



            $aux = NULL;
            $data = array();

//            return $this->render('update', [
//                        'model' => $model,
//                        'aux' => $aux,
//                        'data' => $data,
//            ]);
            return $this->render('update', [
                        'model' => $model,
                        'data' => array(),
                        'aux' => $aux,
                        'rango' => $fecha,
                        'inicial' => $inicial,
                        'final' => $final,
            ]);
        }
    }

    public function actionActres() {

        $id_res = Yii::$app->request->post('id_reservacion');
        $model = $this->findModel($id_res);

        $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();

        if (Yii::$app->request->post('agencia_res') == 'Agencia') {
            Yii::$app->session->setFlash('success', 'Por favor, el campo agencia no puede estar en blanco');
            return $this->render('update', [
                        'model' => $model,
            ]);
        }



        $model->nombre_cliente = Yii::$app->request->post('nom_reservacion');
        $fecha_ent = Yii::$app->request->post('entcambiar');
        $fecha_sal = Yii::$app->request->post('salcambiar');
        $model->agencia = Yii::$app->request->post('agencia_res');
        $model->plan = Yii::$app->request->post('plan_res');
        $model->codigo = Yii::$app->request->post('codigo_res');
        $model->obs = Yii::$app->request->post('obs_res');

        $model->conjunto = 0;

        if (Yii::$app->request->post('conjunto') == 1) {
            $model->conjunto = 1;
        }


        $fe_en = explode('-', $fecha_ent);
        $model->fecha_entrada = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

        $fe_sa = explode('-', $fecha_sal);
        $model->fecha_salida = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa [0];



        $reshabitacion = ReservacionHab::find()->where(['reservacion' => $id_res])->all();

        $des = array();
        $canthab = 0;



        for ($i = 0; $i < count($reshabitacion); $i++) {
            if ($reshabitacion[$i]->hab == Yii::$app->request->post($reshabitacion[$i]->hab)) {

$reshabitacion[$i]->fecha_entrada = $model->fecha_entrada;
                    $reshabitacion[$i]->fecha_salida = $model->fecha_salida;
                    $reshabitacion[$i]->conjunto = $model->conjunto;
                    $reshabitacion[$i]->agencia = $model->agencia;
                    $reshabitacion[$i]->plan = $model->plan;

                $ocup = Yii::$app->request->post($reshabitacion[$i]->hab . 'ocupacionact');
                //print_r($ocup);die;
                if ($ocup != "") {

                    $reshabitacion[$i]->precio = Yii::$app->request->post($reshabitacion[$i]->hab . 'ocupacionprecio');
                    $reshabitacion[$i]->ocupacion = Yii::$app->request->post($reshabitacion[$i]->hab . 'ocupacionact');
                    
                    //  print_r($reshabitacion[$i]->fecha_salida);die;

                    $reshabitacion[$i]->save();
                }
            } else {
                $des[count($des)] = $i;
            }
        }

        //print_r($des[0]);die;

        for ($i = 0; $i < count($des); $i++) {
            $reshabitacion[$des[$i]]->delete();
        }

        // print_r($des);die;


        for ($i = 0; $i < count($hab); $i++) {
            if ($hab[$i]->id == Yii::$app->request->post($hab[$i]->id)) {
                if ($hab[$i]->nombre != 'ANEXO') {
                    $canthab++;
                }
                $control = 0;
                for ($k = 0; $k < count($reshabitacion); $k++) {
                    if ($reshabitacion[$k]->hab == Yii::$app->request->post($hab[$i]->id)) {
                        $control = 1;
                    }
                }
                if ($control == 0) {
                    $ocup = Yii::$app->request->post($hab[$i]->id . 'ocupacionact');
                    if ($ocup != null) {
                        $res = new ReservacionHab();
                        $res->hab = $hab[$i]->id;
                        $res->ocupacion = Yii::$app->request->post($hab[$i]->id . 'ocupacionact');
                        $res->precio = Yii::$app->request->post($hab[$i]->id . 'ocupacionprecio');
                        $res->reservacion = $model->id;
                        $res->fecha_entrada = $model->fecha_entrada;
                        $res->fecha_salida = $model->fecha_salida;
                        $res->estado = 0;
                        $res->conjunto = $model->conjunto;
                        $res->agencia = $model->agencia;
                        $res->plan = $model->plan;
                        $res->save();
                    } else {
                        if ($ocup == "") {
                            Yii::$app->session->setFlash('success', 'Por favor, complete la habitaci�n');
                            return $this->render('update', [
                                        'model' => $model,
                            ]);
                        }
                    }
                }
            }
        }
        $model->canthab = $canthab;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'La reservaci�n se ha actualizado correctamente');
            return $this->redirect(['index']);
        }
    }

    function actionQuitar() {
        $id = Yii::$app->request->get('id');
        $quitar = $this->findModel($id);

        $aux = new Auxiliar();
        $aux->nombre = $quitar->nombre_cliente;
        $aux->fecha_entrada = $quitar->fecha_entrada;

        $aux->fecha_salida = $quitar->fecha_salida;
        $aux->agencia = $quitar->agencia;
        $aux->obs = $quitar->obs;
        $aux->codigo = $quitar->codigo;
        if ($aux->save()) {
            $quitar->delete();
            Yii::$app->session->setFlash('success', 'La reservación se ha quitado correctamente');
            return $this->redirect(['index']);
        }
    }

    function actionServicioExcel() {
        $servxreservas = array();


        $servxreservas[count($servxreservas)] = array(
            'servicio' => '',
            'cantidad' => '',
            'precio' => '',
            'importe' => ''
        );
//        print_r($enviar);die;
        $res = Yii::$app->request->get('id');

//print_r($res);die;
        $imp = 0;

        $todasserv = array();



        /* ESTO ES PARA EL IDIMA ESPANOL */

        $connection = \Yii::$app->db;
        $connection->open();
        $command = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
        $command->bindParam(':reserva', $res);
        $mos_res = $command->queryAll();
        $connection->close();


        if (count($mos_res) != 0) {

            $start_ts = strtotime($mos_res[0]['fecha_entrada']);
            $end_ts = strtotime($mos_res[0] ['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);

            $servxreservas[count($servxreservas)] = array(
                'servicio' => 'ALOJAMIENTO', 'cantidad' => "",
                'precio' => '',
                'importe' => ''
            );

            $mos_hab = [];
            for ($i = 0; $i < count($mos_res); $i++) {
                if ($mos_res [0]['nombre'] != 'ANEXO') {
                    $mos_hab[count($mos_hab)] = $mos_res[$i];
                }
            }

            $mos_res = $mos_hab;


            for ($y = 0; $y < count($mos_res); $y++) {


                $start_ts = strtotime($mos_res[$y]['fecha_entrada']);
                $end_ts = strtotime($mos_res[$y]['fecha_salida']);
                $diferencia = $end_ts - $start_ts;
                $dif_dias = round($diferencia / 86400);

                $servxreservas [count($servxreservas)] = array(
                    'servicio' => $mos_res[$y]['nombre'],
                    'cantidad' => "(" . $dif_dias . ") Noches",
                    'precio' => $mos_res[$y]['precio'],
                    'importe' => Yii::$app->formatter->asDecimal($mos_res[$y]['precio'] * $dif_dias, 2)
                );
                $imp+=$mos_res[$y]['precio'] * $dif_dias;
            }
        }





        $command = $connection->createCommand('select servicio.id,servicio.nombre FROM  servicio,subservicios,rese rvacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.nombre ORDER BY servicio.prioridad');
        $command->bindParam(':reserva', $res);
        $servicios = $command->queryAll();





        for ($i = 0; $i < count($servicios); $i++) {


            $command1 = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.nombre');
            $command1->bindParam(':reserva', $res);
            $command1->bindParam(':serv', $servicios[$i]['id']);
            $subservicios = $command1->queryAll();



            $servxreservas[count($servxreservas)] = array(
                'servicio' => $servicios[$i]['nombre'],
                'cantidad' => ' ',
                'precio' => ' ',
                'importe' => ' '
            );

            for ($k = 0; $k < count($subservicios); $k++) {
                $servxreservas[count($servxreservas)] = array(
                    'servicio' => $subservicios [$k]['nombre'],
                    'cantidad' => $subservicios [$k]['cant'],
                    'precio' => $subservicios[$k]['precio'],
                    'importe' => $subservicios[$k]['total']
                );
                $imp+=$subservicios[$k]['total'];
            }
        }

        $servxreservas[count($servxreservas)] = array(
            'servicio' => '',
            'cantidad' => '',
            'precio' => 'TOTAL',
            'importe' => Yii::$app->formatter->asDecimal($imp, 2)
        );

        $todasserv[count($todasserv)] = $servxreservas;
        $servxreservas = array();
        $imp = 0;



        /* ESTO ES PARA EL IDIOMA INGLES */

        $command = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
        $command->bindParam(':reserva', $res);
        $mos_res = $command->queryAll();
        $connection->close();


        if (count($mos_res) != 0) {

            $start_ts = strtotime($mos_res[0]['fecha_entrada']);
            $end_ts = strtotime($mos_res[0] ['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);

            $servxreservas[count($servxreservas)] = array(
                'servicio' => 'LODGING', 'cantidad' => "",
                'precio' => '',
                'importe' => ''
            );

            $mos_hab = [];
            for ($i = 0; $i < count($mos_res); $i++) {
                if ($mos_res [0]['nombre'] != 'ANEXO') {
                    $mos_hab[count($mos_hab)] = $mos_res[$i];
                }
            }

            $mos_res = $mos_hab;


            for ($y = 0; $y < count($mos_res); $y++) {


                $start_ts = strtotime($mos_res[$y]['fecha_entrada']);
                $end_ts = strtotime($mos_res[$y]['fecha_salida']);
                $diferencia = $end_ts - $start_ts;
                $dif_dias = round($diferencia / 86400);

                $servxreservas[count($servxreservas)] = array(
                    'servicio' => 'ROOM: ' . $mos_res[$y]['nombre'],
                    'cantidad' => "(" . $dif_dias . ") Night(s)",
                    'precio' => $mos_res[$y]['precio'],
                    'importe' => Yii::$app->formatter->asDecimal($mos_res[$y]['precio'] * $dif_dias, 2)
                );
                $imp+=$mos_res[$y]['precio'] * $dif_dias;
            }
        }





        $command = $connection->createCommand('select servicio.id,servicio.ingles FROM  servicio,subservicios,rese rvacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.ingles ORDER BY servicio.prioridad');
        $command->bindParam(':reserva', $res);
        $servicios = $command->queryAll();





        for ($i = 0; $i < count($servicios); $i++) {


            $command1 = $connection->createCommand('select subservicios.ingles, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.ingles');
            $command1->bindParam(':reserva', $res);
            $command1->bindParam(':serv', $servicios[$i]['id']);
            $subservicios = $command1->queryAll();



            $servxreservas[count($servxreservas)] = array(
                'servicio' => $servicios[$i]['ingles'],
                'cantidad' => ' ',
                'precio' => ' ',
                'importe' => ' '
            );

            for ($k = 0; $k < count($subservicios); $k++) {
                $servxreservas[count($servxreservas)] = array(
                    'servicio' => $subservicios [$k]['ingles'],
                    'cantidad' => $subservicios[$k]['cant'],
                    'precio' => $subservicios [$k]['precio'],
                    'importe' => $subservicios[$k]['total']
                );
                $imp+=$subservicios[$k]['total'];
            }
        }

        $servxreservas[count($servxreservas)] = array(
            'servicio' => '',
            'cantidad' => '',
            'precio' => 'TOTAL AMOUNT',
            'importe' => Yii::$app->formatter->asDecimal($imp, 2)
        );

        $todasserv[count($todasserv)] = $servxreservas;
        $servxreservas = array();
        $imp = 0;

        /* ESTO ES PARA EL IDIOMA FRANCES */

        $command = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
        $command->bindParam(':reserva', $res);
        $mos_res = $command->queryAll();
        $connection->close();


        if (count($mos_res) != 0) {

            $start_ts = strtotime($mos_res[0]['fecha_entrada']);
            $end_ts = strtotime($mos_res[0] ['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);

            $servxreservas[count($servxreservas)] = array(
                'servicio' => 'LODGING', 'cantidad' => "",
                'precio' => '',
                'importe' => ''
            );

            $mos_hab = [];
            for ($i = 0; $i < count($mos_res); $i++) {
                if ($mos_res [0]['nombre'] != 'ANEXO') {
                    $mos_hab[count($mos_hab)] = $mos_res[$i];
                }
            }

            $mos_res = $mos_hab;


            for ($y = 0; $y < count($mos_res); $y++) {


                $start_ts = strtotime($mos_res[$y]['fecha_entrada']);
                $end_ts = strtotime($mos_res[$y]['fecha_salida']);
                $diferencia = $end_ts - $start_ts;
                $dif_dias = round($diferencia / 86400);

                $servxreservas[count($servxreservas)] = array(
                    'servicio' => 'CHAMBRE: ' . $mos_res[$y]['nombre'],
                    'cantidad' => "(" . $dif_dias . ") Nuit",
                    'precio' => $mos_res[$y]['precio'],
                    'importe' => Yii::$app->formatter->asDecimal($mos_res[$y]['precio'] * $dif_dias, 2)
                );
                $imp+=$mos_res[$y]['precio'] * $dif_dias;
            }
        }





        $command = $connection->createCommand('select servicio.id,servicio.frances FROM  servicio,subservicios,rese rvacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.ingles ORDER BY servicio.prioridad');
        $command->bindParam(':reserva', $res);
        $servicios = $command->queryAll();





        for ($i = 0; $i < count($servicios); $i++) {


            $command1 = $connection->createCommand('select subservicios.frances, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.ingles');
            $command1->bindParam(':reserva', $res);
            $command1->bindParam(':serv', $servicios[$i]['id']);
            $subservicios = $command1->queryAll();



            $servxreservas[count($servxreservas)] = array(
                'servicio' => $servicios[$i]['frances'],
                'cantidad' => ' ',
                'precio' => ' ',
                'importe' => ' '
            );

            for ($k = 0; $k < count($subservicios); $k++) {
                $servxreservas[count($servxreservas)] = array(
                    'servicio' => $subservicios[$k]['frances'],
                    'cantidad' => $subservicios[$k]['cant'],
                    'precio' => $subservicios [$k]['precio'],
                    'importe' => $subservicios[$k]['total']
                );
                $imp+=$subservicios[$k]['total'];
            }
        }

        $servxreservas[count($servxreservas)] = array(
            'servicio' => '',
            'cantidad' => '',
            'precio' => 'MONTANT TOTAL',
            'importe' => Yii::$app->formatter->asDecimal($imp, 2)
        );

        $todasserv[count($todasserv)] = $servxreservas;






        /* ESTO ES PARA LAS HABITACIONES */

        $hab_res = ReservacionHab::find()->where(['reservacion' => $res])->andWhere(['estado' => 0])->all();


        $todas = array();
        $todashab = array();



        for ($k = 0; $k < count($hab_res); $k++) {
            $imp = 0;
            $result = array();

            $hab = $hab_res[$k]->hab;


            $command = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
            $command->bindParam(':reserva', $res);
            $command->bindParam(':hab', $hab);
            $mos_res = $command->queryAll();



            $result[count($result)] = array(
                'servicio' => 'ALOJAMIENTO',
                'cantidad' => '',
                'precio' => '',
                'importe' => ''
            );


            $start_ts = strtotime($mos_res[0]['fecha_entrada']);
            $end_ts = strtotime($mos_res [0]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);

            $result[count($result)] = array(
                'servicio' => $mos_res[0]['nombre'],
                'cantidad' => "(" . $dif_dias . ") Noches",
                'precio' => $mos_res[0]['precio'],
                'importe' => $mos_res[0]['precio'] * $dif_dias
            );
            $imp+=$mos_res[0]['precio'] * $dif_dias;


            $command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=su bservicios.servicio and  subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.nombre');
            $command->bindParam(':reserva', $res);
            $command->bindParam(':hab', $hab);
            $servicios = $command->queryAll();

            for ($i = 0; $i < count($servicios); $i++) {

                $command1 = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.nombre');
                $command1->bindParam(':reserva', $res);
                $command1->bindParam(':hab', $hab);
                $command1->bindParam(' :serv', $servicios[$i]['id']);
                $subservicios = $command1->queryAll();



                $result[count($result)] = array(
                    'servicio' => $servicios[$i]['nombre'],
                    'cantidad' => ' ',
                    'precio' => ' ',
                    'importe' => ' '
                );


                for ($m = 0; $m < count($subservicios); $m++) {
                    $result[count($result)] = array(
                        'servicio' => $subservicios[$m]['nombre'],
                        'cantidad' => $subservicios[$m]['cant'],
                        'precio' => $subservicios[$m]['precio'],
                        'importe' => $subservicios[$m]['total']
                    );
                    $imp+=$subservicios[$k]['total'];
                }
            }

            $result[count($result)] = array(
                'servicio' => '',
                'cantidad' => '',
                'precio' => 'Importe',
                'importe' => $imp
            );



            $todas[count($todas)] = $result;
            $result = array();
            $imp = 0;

            /* ESTO ES PARA EL IDIOMA INGLES */

            $command = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
            $command->bindParam(':reserva', $res);
            $command->bindParam(':hab', $hab);
            $mos_res = $command->queryAll();



            $result[count($result)] = array(
                'servicio' => 'LODGING',
                'cantidad' => '',
                'precio' => '',
                'importe' => ''
            );


            $start_ts = strtotime($mos_res[0]['fecha_entrada']);
            $end_ts = strtotime($mos_res[0]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);

            $result[count($result)] = array(
                'servicio' => 'ROOM: ' . $mos_res[0]['nombre'],
                'cantidad' => "(" . $dif_dias . ")  Night(s)",
                'precio' => $mos_res[0]['precio'],
                'importe' => $mos_res[0]['precio'] * $dif_dias
            );
            $imp+=$mos_res[0]['precio'] * $dif_dias;


            $command = $connection->createCommand('select servicio.id,servicio.ingles FROM servicio,subservicios,reservacion_servicios where servicio.id=su bservicios.servicio and  subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.ingles');
            $command->bindParam(':reserva', $res);
            $command->bindParam(':hab', $hab);
            $servicios = $command->queryAll();

            for ($i = 0; $i < count($servicios); $i++) {

                $command1 = $connection->createCommand('select subservicios.ingles, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.ingles');
                $command1->bindParam(':reserva', $res);
                $command1->bindParam(':hab', $hab);
                $command1->bindParam(' :serv', $servicios[$i]['id']);
                $subservicios = $command1->queryAll();



                $result[count($result)] = array(
                    'servicio' => $servicios[$i]['ingles'],
                    'cantidad' => ' ',
                    'precio' => ' ',
                    'importe' => ' '
                );


                for ($m = 0; $m < count($subservicios); $m++) {
                    $result[count($result)] = array(
                        'servicio' => $subservicios[$m]['ingles'],
                        'cantidad' => $subservicios[$m]['cant'],
                        'precio' => $subservicios[$m]['precio'],
                        'importe' => $subservicios[$m]['total']
                    );
                    $imp+=$subservicios[$k]['total'];
                }
            }

            $result[count($result)] = array(
                'servicio' => '',
                'cantidad' => '',
                'precio' => 'TOTAL AMOUNT',
                'importe' => $imp
            );



            $todas[count($todas)] = $result;
            $result = array();
            $imp = 0;

            /* ESTO ES PARA EL IDIOMA FRANCES */

            $command = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
            $command->bindParam(':reserva', $res);
            $command->bindParam(':hab', $hab);
            $mos_res = $command->queryAll();



            $result[count($result)] = array(
                'servicio' => 'LOGEMENT',
                'cantidad' => '',
                'precio' => '',
                'importe' => ''
            );


            $start_ts = strtotime($mos_res[0]['fecha_entrada']);
            $end_ts = strtotime($mos_res[0]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);

            $result[count($result)] = array(
                'servicio' => 'CHAMBRE: ' . $mos_res[0]['nombre'],
                'cantidad' => "(" . $dif_dias . ")  Nuit",
                'precio' => $mos_res[0]['precio'],
                'importe' => $mos_res[0]['precio'] * $dif_dias
            );
            $imp+=$mos_res[0]['precio'] * $dif_dias;


            $command = $connection->createCommand('select servicio.id,servicio.frances FROM servicio,subservicios,reservacion_servicios where servicio.id=sub servicios.servicio and s ubservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.frances');
            $command->bindParam(':reserva', $res);
            $command->bindParam(':hab', $hab);
            $servicios = $command->queryAll();

            for ($i = 0; $i < count($servicios); $i++) {

                $command1 = $connection->createCommand('select subservicios.frances, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.frances');
                $command1->bindParam(':reserva', $res);
                $command1->bindParam(':hab', $hab);
                $command1->bindParam(': serv', $servicios[$i]['id']);
                $subservicios = $command1->queryAll();



                $result[count($result)] = array(
                    'servicio' => $servicios[$i]['frances'],
                    'cantidad' => ' ',
                    'precio' => ' ',
                    'importe' => ' '
                );


                for ($m = 0; $m < count($subservicios); $m++) {
                    $result[count($result)] = array(
                        'servicio' => $subservicios[$m]['frances'],
                        'cantidad' => $subservicios[$m]['cant'],
                        'precio' => $subservicios[$m]['precio'],
                        'importe' => $subservicios[$m]['total']
                    );
                    $imp+=$subservicios[$k]['total'];
                }
            }

            $result[count($result)] = array(
                'servicio' => '',
                'cantidad' => '',
                'precio' => 'MONTANT TOTAL',
                'importe' => $imp
            );



            $todas[count($todas)] = $result;
            $todashab[count($todashab)] = $todas;
            $todas = array();
        }


//  print_r($todas);die;

        return $this->render('servicio-excel', [
                    'todasserv' => $todasserv, 'hab' => $todashab,
        ]);
    }

    public function actionDenegadas() {
        $reservacion = new ReservacionesDenegadas ();
        return $this->render('denegadas', [
                    'model' => $reservacion,
        ]);
    }

    public function actionAddenegada() {
        $reservacion = new ReservacionesDenegadas();


        $fe_en = explode('-', Yii::$app->request->post('fechaent_denegada'));
        $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

        $fe_sa = explode('-', Yii::$app->request->post('fechasal_denegada'));
        $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

        $reservacion->nombre_cliente = Yii::$app->request->post('res_denegada');
        $reservacion->fecha_solicitud = date('Y-m-d');
        $reservacion->fecha_entrada = $fecha_ent;
        $reservacion->fecha_salida = $fecha_sal;

        $simple = 0;
        $doble = 0;
        $twins = 0;
        $triple = 0;

        if (Yii::$app->request->post('simple') != "") {
            $simple = Yii::$app->request->post('simple');
        }
        if (Yii::$app->request->post('doble') != "") {
            $doble = Yii::$app->request->post('doble');
        }
        if (Yii::$app->request->post('twins') != "") {
            $twins = Yii::$app->request->post('twins');
        }
        if (Yii::$app->request->post('triple') != "") {
            $triple = Yii::$app->request->post('triple');
        }
        $reservacion->simple = $simple;
        $reservacion->doble = $doble;
        $reservacion->twins = $twins;
        $reservacion->triple = $triple;

        $reservacion->agencia = Yii::$app->request->post('agencia');

        $reservacion->obs = Yii::$app->request->post('obs');

        if ($reservacion->save()) {
            Yii::$app->session->setFlash('success', 'La reservación denegada se ha creado correctamente');
            return $this->redirect(['index', 'tab' => 2]);
        } else {
            return $this->render('denegadas', [

                        'model' => $reservacion,
            ]);
        }
    }

    public function actionDeldenegadas() {
        $id = Yii::$app->request->get('id');
        $del = ReservacionesDenegadas::findAll(['id' => $id]);
        $del[0]->delete();
        Yii::$app->session->setFlash('success', 'La reservación denegada se ha eliminado correctamente');
        return $this->redirect(['index', 'tab' => 2]);
    }

    public function actionActdenegadas() {
        $id = Yii::$app->request->get('id');
        $act = ReservacionesDenegadas::findAll(['id' => $id]);

        return $this->render('actdenegadas', [
                    'model' => $act[0],
        ]);
    }

    public function actionActdenegadaup() {
        $id = Yii::$app->request->post('id_denegada');
        $reservacion = ReservacionesDenegadas::findAll(['id' => $id]);


        $nombre = Yii::$app->request->post('res_denegada');
        $entrada = Yii::$app->request->post('fechaent_denegada');
        $salida = Yii::$app->request->post('fechasal_denegada');

        $fe_en = explode('-', $entrada);
        $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

        $fe_sal = explode('-', $salida);
        $fecha_sal = $fe_sal[2] . '-' . $fe_sal[1] . '-' . $fe_sal[0];

        $simple = 0;
        $doble = 0;
        $twins = 0;
        $triple = 0;

        if (Yii::$app->request->post('simple') != "") {
            $simple = Yii::$app->request->post('simple');
        }
        if (Yii::$app->request->post('doble') != "") {
            $doble = Yii::$app->request->post('doble');
        }
        if (Yii::$app->request->post('twins') != "") {
            $twins = Yii::$app->request->post('twins');
        }
        if (Yii::$app->request->post('triple') != "") {
            $triple = Yii::$app->request->post('triple');
        }



        $reservacion[0]->nombre_cliente = $nombre;
        $reservacion[0]->fecha_solicitud = date('Y-m-d');
        $reservacion[0]->fecha_entrada = $fecha_ent;
        $reservacion[0]->fecha_salida = $fecha_sal;
        $reservacion[0]->simple = $simple;
        $reservacion[0]->doble = $doble;
        $reservacion[0]->twins = $twins;
        $reservacion[0]->triple = $triple;

        $reservacion[0]->agencia = Yii::$app->request->post('agencia');

        $reservacion[0]->obs = Yii::$app->request->post('obs');

        if ($reservacion[0]->save()) {
            Yii::$app->session->setFlash('success', 'La solicitud denegada se ha actualizado correctamente');
            return $this->redirect(['index', 'tab' => 2]);
        } else {
            return $this->render('denegadas', [

                        'model' => $reservacion,
            ]);
        }
    }

    public function actionIndex() {
        $searchModel = new ReservacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $tab = Yii::$app->request->get('tab');


        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'tab' => $tab,
        ]);
    }

    public function actionServicio() {


        $reservacion = $this->findModel(Yii::$app->request->get('id'));

        return $this->render('servicio', [
                    'model' => $reservacion,
        ]);
    }

    public function actionTerminada() {


        $reservacion = $this->findModel(Yii::$app->request->get('id'));

        return $this->render('terminada', [
                    'model' => $reservacion,
        ]);
    }

    public function actionCambiar() {
        $reservacion = $this->findModel(Yii::$app->request->get('id'));
        return $this->render('cambiar', [
                    'model' => $reservacion,
        ]);
    }

    function actionAddcambiar() {
        $reservacion = $this->findModel(Yii::$app->request->post('id_reserva'));
        $reservacion_hab = ReservacionHab::find()->where(['reservacion' => $reservacion->id])->andWhere(['estado' => 0])->all();



//        $timezone = "America/Atikokan";
//        $dt = new datetime("now", new datetimezone($timezone));



        $fecha = Yii::$app->request->post('salcambiar');
        $fe_sa = explode('-', $fecha);
        $fecha = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

//        print_r(gmdate("Y-m-d", (time() + $dt->getOffset())));
        //die;

        $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();

        $bandera = -1;
        $ban = -1;
        $canthab = 0;

        for ($i = 0; $i < count($hab); $i++) {
            if ($hab[$i]->id == Yii::$app->request->post($hab[$i]->id)) {

                if ($hab[$i]->nombre != 'ANEXO') {
                    $canthab++;
                }

                $ban = 1;
                $res_hab = new ReservacionHab();
                $res_hab->reservacion = $reservacion->id;
                $res_hab->hab = $hab[$i]->id;
                $res_hab->ocupacion = Yii::$app->request->post($hab[$i]->id . 'ocupacion');
                $res_hab->precio = Yii::$app->request->post($hab[$i]->id . 'ocupacionprecio');
                $res_hab->fecha_entrada = date('Y-m-d');
                $res_hab->fecha_salida = $fecha;
                $res_hab->agencia = $reservacion_hab[0]->agencia;
                $res_hab->conjunto = $reservacion_hab[0]->conjunto;
                $res_hab->plan = $reservacion_hab[0]->plan;
                $res_hab->estado = 0;
                $res_hab->save();
            }
        }
        $bandera = 1;
        if ($bandera != -1) {
            for ($i = 0; $i < count($reservacion_hab); $i++) {
                if ($reservacion_hab[$i]->id != Yii::$app->request->post($reservacion_hab[$i]->id)) {
                    $reservacion_hab[$i]->estado = 1;
                    $reservacion_hab [$i]->fecha_entrada = $reservacion->fecha_entrada;
                    $reservacion_hab[$i]->fecha_salida = date('Y-m-d');
                    $reservacion_hab[$i]->save();
                } else {
                    if ($hab[$i]->nombre != 'ANEXO') {
                        $canthab++;
                    }
                    $reservacion_hab[$i]->fecha_salida = $fecha;
                    $reservacion_hab[$i]->precio = Yii::$app->request->post($reservacion_hab[$i]->id . 'ocupacionprecio');
                    $reservacion_hab[$i]->save();
                }
            }
            $reservacion->fecha_salida = $fecha;
            $reservacion->canthab = $canthab;
            $reservacion->save();
            Yii::$app->session->setFlash('success', 'Se ha realizado el cambio correctamente');
            return $this->render('cambiar', [
                        'model' => $reservacion,
            ]);
        } else {
            Yii::$app->session->setFlash('success', 'Debe completar el llenado de la habitación para cambiar');
            return $this->render('cambiar', [
                        'model' => $reservacion,
            ]);
        }
    }

    public function actionAdd() {
        $model1 = new ReservacionServicios();

        if ($model1->load(Yii::$app->request->post())) {

//            $timezone = "America/Atikokan";
//            $dt = new datetime("now", new datetimezone($timezone));
//            $fecha = gmdate("d-m-Y", (time() + $dt->getOffset()));
//            
//            echo $fecha;die;

            $incluir = Yii::$app->request->post('incluir');
            $ingreso = Yii::$app->request->post('rdingresos');
            $ser = Yii::$app->request->post('id_sub');
            $model1->fecha = date("Y-m-d");

            $hab = Yii::$app->request->post('hab_ide');

            if ($hab == "") {
                $habitaciones = ReservacionHab::find()->where(['reservacion' => $model1->reservacion])->all();
                $hab = $habitaciones[0]->hab;
            }



            $model1->servicio = $ser;
            $model1->estado = 0;

            if ($incluir == 1) {
                $model1->estado = 1;
            }

            if ($ingreso == 1) {
                $model1->estado = 2;
            }

            $model1->hab = $hab;
//            print_r($model1);die;

            if ($model1->save()) {
                return $this->redirect(['servicio',
                            'id' => $model1->reservacion
//'hab' => $model1->hab
                ]);
            } else {

                return $this->redirect(['servicio',
                            'id' => $model1->reservacion
//'hab' => $model1->hab
                ]);
            }
        }
    }

    function actionCheked() {
        $id = Yii::$app->request->get('id');
        $res = Reservacion::find()->where(['id' => $id])->all();
        $res[0]->estado = 2;
        $res[0]->save();
        return $this->redirect(['index']);
    }

    function actionReportes() {
        return $this->render('reportes', [
                    'rep_reservas' => array(),
                    'rep_gastos' => array()
        ]);
    }

    function actionInfo() {
        $fe_entrada = Yii::$app->request->post('rep_entrada');
        $fe_salida = Yii::$app->request->post('rep_salida');


        $fe_en = explode('-', $fe_entrada);
        $fe_entrada = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

        $fe_sa = explode('-', $fe_salida);
        $fe_salida = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];



        $result = array();
        $result1 = array();

        if ($fe_entrada == '' || $fe_salida == '') {
            Yii::$app->session->setFlash('error', 'Por favor llene todos los campos de fecha');
            return $this->render('reportes', [
                        'rep_reservas' => $result,
                        'rep_gastos' => $result1
            ]);
        }



        if ($fe_entrada > $fe_salida) {
            Yii::$app->session->setFlash('error', 'La fecha entrada debe ser menor que la salida');


            return $this->render('reportes', [
                        'rep_reservas' => $result,
                        'rep_gastos' => $result1
            ]);
        } else {

            /* Buscar los gastos para ese periodo d fecha */

            $connection = \Yii::$app->db;
            $connection->open();

            $command = $connection->createCommand('select reservacion.id,reservacion_hab.precio,reservacion.nombre_cliente,reservacion.fecha_entrada,reservacion.fecha_salida,agencia.nombre as agencia,reservacion.obs from reservacion,agencia,habitacion,reservacion_hab where reservacion.id=reservacion_hab.reservacion and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and estado=2 and fecha_entrada>=:fecha_entrada and fecha_salida <=:fecha_salida GROUP BY reservacion.nombre_cliente order by reservacion.fecha_entrada desc');
            $command->bindParam(':fecha_entrada', $fe_entrada);
            $command->bindParam(':fecha_salida', $fe_salida);
            $result = $command->queryAll();



            $command1 = $connection->createCommand('SELECT * FROM addgastos WHERE fecha>=:entrada and fecha <=:salida order by fecha desc');
            $command1->bindParam(':entrada', $fe_entrada);
            $command1->bindParam(':salida', $fe_salida);
            $result1 = $command1->queryAll();



            if (count($result) == 0 && count($result1) != 0) {
                Yii::$app->session->setFlash('success', 'La buequeda se realizo correctamente pero no arrojo resulado en las reservaciones');
            }
            if (count($result1) == 0 && count($result) != 0) {
                Yii::$app->session->setFlash('success', 'La buequeda se realizo correctamente pero no arrojo resulado en los gastos');
            }
            if (count($result1) == 0 && count($result) == 0) {
                Yii::$app->session->setFlash('success', 'La buequeda se realizo correctamente pero no arrojo resulado');
            }

            if (count($result1) != 0 && count($result) != 0) {
                Yii::$app->session->setFlash('success', 'La buequeda se realizo correctamente');
            }

            return $this->render('reportes', [
                        'rep_reservas' => $result,
                        'rep_gastos' => $result1
            ]);
        }
    }

    public function actionInfores() {
        $id_res = Yii::$app->request->get('id');

        $alojamiento = ReservacionHab::find()->where(['reservacion' => $id_res])->andWhere(['conjunto' => 0])->all();

        $serv = ReservacionServicios::find()
                ->innerJoin('subservicios', $on = 'reservacion_servicios.servicio=subservicios.id')
                ->innerJoin('servicio', $on = 'subservicios.servicio=servicio.id')
                ->where(['reservacion_servicios.reservacion' => $id_res])
                //->andWhere(['reservacion_servicios.estado' => 0])
                ->groupBy('servicio.id,reservacion_servicios.precio,reservacion_servicios.id')
                ->orderBy('servicio.prioridad asc')
                ->all();




        return $this->render('info', [
                    'serv' => $serv,
                    'aloj' => $alojamiento,
                    'id_res' => $id_res,
        ]);
    }

    public function actionInforesterminada() {
        $id_res = Yii::$app->request->get('id');

        $alojamiento = ReservacionHab::find()->where(['reservacion' => $id_res])->andWhere(['conjunto' => 0])->all();

        $serv = ReservacionServicios::find()
                ->innerJoin('subservicios', $on = 'reservacion_servicios.servicio=subservicios.id')
                ->innerJoin('servicio', $on = 'subservicios.servicio=servicio.id')
                ->where(['reservacion_servicios.reservacion' => $id_res])
                //->andWhere(['reservacion_servicios.estado' => 0])
                ->groupBy('servicio.id,reservacion_servicios.precio,reservacion_servicios.id')
                ->orderBy('servicio.prioridad asc')
                ->all();




        return $this->render('infoterminada', [
                    'serv' => $serv,
                    'aloj' => $alojamiento,
                    'id_res' => $id_res,
        ]);
    }

    public function actionDelete_serv() {
        $id_serv = Yii::$app->request->get('id');
        $id = Yii::$app->request->get('res');

        ReservacionServicios::deleteAll(['id' => $id_serv]);

        Yii::$app->session->setFlash('success', 'El servicio se ha eliminado correctamente');
        return $this->redirect(['infores',
                    'id' => $id,
        ]);
    }

    public function actionDelete_servterminada() {
        $id_serv = Yii::$app->request->get('id');
        $id = Yii::$app->request->get('res');

        ReservacionServicios::deleteAll(['id' => $id_serv]);

        Yii::$app->session->setFlash('success', 'El servicio se ha eliminado correctamente');
        return $this->redirect(['inforesterminada',
                    'id' => $id,
        ]);
    }

    public function actionBuscar_res() {

        $id_res = Yii::$app->request->post('id_reservac');
        $entrada = Yii::$app->request->post('buscar_ent');
        $salida = Yii::$app->request->post('buscar_salida');

        $model = $this->findModel($id_res);

        $fe = explode('-', $model->fecha_entrada);
        $model->fecha_entrada = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

        $fe = explode('-', $model->fecha_salida);
        $model->fecha_salida = $fe[2] . '-' . $fe[1] . '-' . $fe[0];


        $fe_en = explode('-', $entrada);
        $entrada = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

        $fe_sa = explode('-', $salida);
        $salida = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];




        $start_ts = strtotime($entrada);
        $end_ts = strtotime($salida);
        $diferencia = $end_ts - $start_ts;
        $dif_dias = round($diferencia / 86400) - 1;

        $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();
        $data = array();


        for ($i = 0; $i < $dif_dias; $i++) {

            $mod_date = strtotime($entrada . "+ 2 days");
            $fe_salida = date("Y-m-d", $mod_date);

            $mod_date1 = strtotime($entrada . "+ 1 days");
            $entrada = date("Y-m-d", $mod_date1);



            for ($k = 0; $k < count($hab); $k++) {
                $id_hab = $hab[$k]->id;

//                $entrada = '2018-02-05';
//                $fe_salida = '2018-02-06';

                $connection = \Yii::$app->db;
                $connection->open();

                $command = $connection->createCommand('SELECT reservacion.nombre_cliente FROM reservacion,reservacion_hab WHERE  (reservacion_hab.hab = :habitacion) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion.fecha_entrada <= :entrada1) AND (reservacion.fecha_salida > :salida1) AND (reservacion_hab.estado=0)  OR (reservacion.fecha_entrada <=:entrada2 ) AND (reservacion.fecha_salida >= :salida2) AND (reservacion.fecha_entrada > :entrada3 AND reservacion.fecha_entrada < :salida3) AND  (reservacion_hab.hab = :habitacion1)AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0) OR (reservacion.fecha_salida > :entrada4 AND reservacion.fecha_salida < :salida4) AND (reservacion_hab.hab = :habitacion2) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0)');
                $command->bindParam(':habitacion', $id_hab);
                $command->bindParam(':entrada1', $entrada);
                $command->bindParam(':salida1', $entrada);
                $command->bindParam(':entrada2', $fe_salida);
                $command->bindParam(':salida2', $fe_salida);
                $command->bindParam(':entrada3', $entrada);
                $command->bindParam(':salida3', $fe_salida);
                $command->bindParam(':habitacion1', $id_hab);
                $command->bindParam(':entrada4', $entrada);
                $command->bindParam(':salida4', $fe_salida);
                $command->bindParam(':habitacion2', $id_hab);
                $result = $command->queryAll();
                $connection->close();

                //print_r($result);

                /* OJO REVISAR CAUTELOZAMENTE ES X AKI */

                if (count($result) == 0) {
                    $data[count($data)] = array(
                        'id_hab' => $id_hab,
                        'nombre' => $hab[$k]->nombre,
                        'fecha_entrada' => $entrada,
                        'fecha_salida' =>
                        $fe_salida,
                    );
                }
            }
        }

        //$aux = NULL;




        return $this->render('update', [
                    'model' => $model,
                    //'aux' => $aux,
                    'data' => $data,
        ]);
    }

    /**
     * Displays a single Reservacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reservacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {



        $aux = new Auxiliar();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $aux = Auxiliar::find()->where([ 'id' => $id])->all();
        }



        $model = new Reservacion ( );
        $model->estado = 0;
        //echo Yii::$app->request->post('$hab[$i]->id');
        if ($model->load(Yii::$app->request->post())) {
            $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();


            $fecha_ent = $model->fecha_entrada;
            $fecha_sal = $model->fecha_salida;



            $fe_en = explode('-', $fecha_ent);
            $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

            $fe_sa = explode('-', $fecha_sal);
            $fecha_sal = $fe_sa[2] . '-' . $fe_sa [1] . '-' . $fe_sa [0];


            $model->fecha_entrada = $fecha_ent;
            $model->fecha_salida = $fecha_sal;

            $cont = 0;
            $canthab = 0;









            for ($i = 0; $i < count($hab); $i++) {
                if ($hab[$i]->id == Yii::$app->request->post($hab[$i]->id)) {
                    $id_hab = $hab[$i]->id;


                    if (Yii:: $app->request->post($hab[$i]->id . 'ocupacion') == "" || Yii::$app->request->post($hab [$i]->id . 'ocupacionprecio') == "") {
                        Yii::$app->session->setFlash('error', 'Por favor complete la habitación');
                        $fecha_ent = $model->fecha_entrada;
                        $fecha_sal = $model->fecha_salida;


                        $fe_en = explode('-', $fecha_ent);
                        $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];


                        $fe_sa = explode('-', $fecha_sal);
                        $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa [0];


                        $model->fecha_entrada = $fecha_ent;
                        $model->fecha_salida = $fecha_sal;

                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                    }


                    $conj = Yii::$app->request->post('conjunto');
                    if ($conj == 1) {
                        $model->conjunto = 1;
                    } else {
                        $model->conjunto = 0;
                    }

                    if ($cont == 0) {
                        $model->save();
                        $cont++;
                    }

                    $res = new ReservacionHab();
                    $res->hab = $hab[$i]->id;
                    $res->ocupacion = Yii::$app->request->post($hab[$i]->id . 'ocupacion');
                    $res->precio = Yii::$app->request->post($hab[$i]->id . 'ocupacionprecio');
                    $res->reservacion = $model->id;
                    $res->fecha_entrada = $model->fecha_entrada;
                    $res->fecha_salida = $model->fecha_salida;
                    $res->estado = 0;
                    $res->conjunto = $model->conjunto;
                    $res->agencia = $model->agencia;
                    $res->plan = $model->plan;


                    $res->save();
                    if ($hab[$i]->nombre != 'ANEXO') {
                        $canthab++;
                    }
                }
            }

            if ($cont != 0) {
                $model->canthab = $canthab;
                $model->save();
                Yii::$app->session->setFlash('success', 'La reservación se ha creado correctamente');

                return $this->redirect(['index', 'tab' => 1]);
            } else {
                $fecha_ent = $model->fecha_entrada;
                $fecha_sal = $model->fecha_salida;


                $fe_en = explode('-', $fecha_ent);
                $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

                $fe_sa = explode('-', $fecha_sal);
                $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];


                $model->fecha_entrada = $fecha_ent;

                $model->fecha_salida = $fecha_sal;
                Yii::$app->session->setFlash('error', 'Por favor complete la habitación');
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
     * Updates an existing Reservacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */ public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);

//        $fecha_ent = Yii::$app->request->post("Reservacion[fecha_entrada]");
        //        $fecha_sal = Yii::$app->request->post("Reservacion[fecha_salida]");        

        $cont = 0;

        $start_ts = strtotime($model->fecha_entrada);
        $end_ts = strtotime($model->fecha_salida);
        $diferencia = $end_ts - $start_ts;
        $dif_dias = round($diferencia / 86400) - 1;

        $fe = explode('-', $model->fecha_entrada);
        $inicial = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

        $fecha = array();
        $fecha[count($fecha)] = $inicial;
        $inicial1 = $inicial;

        for ($i = 0; $i < $dif_dias; $i++) {
            $mod_date1 = strtotime($inicial1 . "+ 1 days");
            $inicial1 = date("d-m-Y", $mod_date1);
            $fecha[count($fecha)] = $inicial1;
        }








        //$fe = explode('-', $model->fecha_entrada);
        $model->fecha_entrada = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

        $fe = explode('-', $model->fecha_salida);
        $model->fecha_salida = $fe[2] . '-' . $fe[1] . '-' . $fe[0];
        $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();





        /* AQUI ES DONDE DEBO BUSCAR LAS HAB DISPONIBLES PARA EL PERIODO DE FECHA SELECCIONADO */
        $data = array();

        $fe = explode('-', $model->fecha_entrada);
        $fecha_ent1 = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

        $fe = explode('-', $model->fecha_salida);
        $fecha_sal1 = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

        for ($i = 0; $i < count($hab); $i++) {
            $id_hab = $hab[$i]->id;

            $connection = \Yii::$app->db;
            $connection->open();

            $command = $connection->createCommand('SELECT reservacion.nombre_cliente FROM reservacion,reservacion_hab WHERE  (reservacion_hab.hab = :habitacion) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion.fecha_entrada <= :entrada1) AND (reservacion.fecha_salida > :salida1) OR (reservacion.fecha_entrada <=:entrada2 ) AND (reservacion.fecha_salida >= :salida2) AND (reservacion.fecha_entrada > :entrada3 AND reservacion.fecha_entrada < :salida3) AND  (reservacion_hab.hab = :habitacion1)AND (reservacion.id=reservacion_hab.reservacion) OR (reservacion.fecha_salida > :entrada4 AND reservacion.fecha_salida < :salida4) AND (reservacion_hab.hab = :habitacion2) AND (reservacion.id=reservacion_hab.reservacion)');
            $command->bindParam(':habitacion', $id_hab);
            $command->bindParam(':entrada1', $fecha_ent1);
            $command->bindParam(':salida1', $fecha_ent1);
            $command->bindParam(':entrada2', $fecha_sal1);
            $command->bindParam(':salida2', $fecha_sal1);
            $command->bindParam(':entrada3', $fecha_ent1);
            $command->bindParam(':salida3', $fecha_sal1);
            $command->bindParam(':habitacion1', $id_hab);
            $command->bindParam(':entrada4', $fecha_ent1);
            $command->bindParam(':salida4', $fecha_sal1);
            $command->bindParam(':habitacion2', $id_hab);
            $result = $command->queryAll();
            $connection->close();

            if (count($result) == 0) {
                $data[count($data)] = array(
                    'id_hab' => $id_hab,
                    'nombre' => $hab[$i]->nombre,
                    'fecha_entrada' => $model->fecha_entrada,
                    'fecha_salida' => $model->fecha_salida,
                );
            }
        }


        if ($model->load(Yii::$app->request->post())) {

            $fe = explode('-', $model->fecha_entrada);
            $model->fecha_entrada = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

            $fe = explode('-', $model->fecha_salida);
            $model->fecha_salida = $fe[2] . '-' . $fe[1] . '-' . $fe[0];


//ReservacionHab::deleteAll(['reservacion' => $id]);

            if ($model->agencia == "Agencia") {
                Yii::$app->session->setFlash('success', 'Por favor, debe seleccionr una agencia');
                $aux = NULL;

                return $this->render('update', [
                            'model' => $model,
                            'data' => $data,
                            'aux' => $aux,
                            'rango' => $fecha,
                            'inicial' => $inicial,
                            'final' => $model->fecha_salida,
                ]);
            }




            for ($i = 0; $i < count($hab); $i++) {
                if ($hab[$i]->id == Yii::$app->request->post($hab[$i]->id)) {






                    $id_hab = $hab[$i]->id;

                    $connection = \Yii::$app->db;
                    $connection->open();

                    $command = $connection->createCommand('SELECT reservacion.nombre_cliente FROM reservacion,reservacion_hab WHERE  (reservacion_hab.hab = :habitacion) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion.fecha_entrada <= :entrada1) AND (reservacion.fecha_salida > :salida1) OR (reservacion.fecha_entrada <=:entrada2 ) AND (reservacion.fecha_salida >= :salida2) AND (reservacion.fecha_entrada > :entrada3 AND reservacion.fecha_entrada < :salida3) AND  (reservacion_hab.hab = :habitacion1)AND (reservacion.id=reservacion_hab.reservacion) OR (reservacion.fecha_salida > :entrada4 AND reservacion.fecha_salida < :salida4) AND (reservacion_hab.hab = :habitacion2) AND (reservacion.id=reservacion_hab.reservacion)');
                    $command->bindParam(':habitacion', $id_hab);
                    $command->bindParam(':entrada1', $fecha_ent);
                    $command->bindParam(':salida1', $fecha_ent);
                    $command->bindParam(':entrada2', $fecha_sal);
                    $command->bindParam(':salida2', $fecha_sal);
                    $command->bindParam(':entrada3', $fecha_ent);
                    $command->bindParam(':salida3', $fecha_sal);
                    $command->bindParam(':habitacion1', $id_hab);
                    $command->bindParam(':entrada4', $fecha_ent);
                    $command->bindParam(':salida4', $fecha_sal);
                    $command->bindParam(':habitacion2', $id_hab);
                    $result = $command->queryAll();
                    $connection->close();


//                    print_r($result);
//                    die;

                    if (count($result) == 0) {
                        if ($cont == 0) {
//$model->save();
                            ReservacionHab::deleteAll(['reservacion' => $model->id]);
                            $cont++;
                        }

//                        echo $hab[$i]->id .'<br>';
                        $res = new ReservacionHab();
                        $res->hab = $hab[$i]->id;
                        $res->ocupacion = Yii::$app->request->post($hab[$i]->id . 'ocupacion');
                        $res->precio = Yii::$app->request->post($hab[$i]->id . 'ocupacionprecio');
                        $res->reservacion = $model->id;
                        $res->fecha_entrada = $model->fecha_entrada;
                        $res->fecha_salida = $model->fecha_salida;
                        $res->estado = 0;
                        $res->conjunto = $model->conjunto;
                        $res->agencia = $model->agencia;
                        $res->plan = $model->plan;
//echo var_dump($res);die;
                        $res->save();
                    } else {
//                        return $this->redirect(['index', 'men_res' => 0]);
                        $nom_hab.=" " . $hab[$i]->nombre;
                    }
                }
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'La reservación se ha actualizado correctamente');
                return $this->redirect(['index']);
            }
        } else {
            //$aux = NULL;

            return $this->render('update', [
                        'model' => $model,
                        'data' => $data,
                        'aux' => array(),
                        'rango' => $fecha,
                        'inicial' => $inicial,
                        'final' => $model->fecha_salida,
            ]);
        }
    }

    public function actionActiva() {
        $id = Yii::$app->request->get('id');
        $mod = $this->findModel($id);

        $mod->estado = 1;
        $mod->save();
        Yii::$app->session->setFlash('success', 'La reservación se ha activado correctamente');
        return $this->redirect(['index', 'tab' => 1]);
    }

    /**
     * Deletes an existing Reservacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $id = Yii::$app->request->get('id');
        $tab = Yii::$app->request->get('tab');
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'La reservación se ha eliminado correctamente');
        return $this->redirect(['index', 'tab' => $tab]);
    }

    /**
     * Finds the Reservacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reservacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Reservacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
