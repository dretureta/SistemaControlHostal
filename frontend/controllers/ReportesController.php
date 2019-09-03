<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Agencia;
use frontend\models\ReservacionServicios;
use frontend\models\Pasadia;
use frontend\models\PasadiaServicio;
use frontend\models\Reservacion;
use frontend\models\ReservacionHab;
use frontend\models\TrabFunciones;

/**
 * AgenciaController implements the CRUD actions for Agencia model.
 */
class ReportesController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    function actionAgencia() {
        $mesexcel = '';
        $agenciaexcel = '';
        $clienteexcel = '';
        return $this->render('agencia', [
                    'mesexcel' => $mesexcel,
                    'agenciaexcel' => $agenciaexcel,
                    'clienteexcel' => $clienteexcel,
        ]);
    }

    function actionAgenciaExcel() {
        $agencia = Yii::$app->request->post('agenciaexcel');
        $cliente = Yii::$app->request->post('clienteexcel');

        $rep_inicial = Yii::$app->request->post('mesexcel');




        $fe_en = explode('-', $rep_inicial);
        $rep_inicial = $fe_en[1] . '-' . $fe_en[0];



        $fec = "%" . $rep_inicial . "%";



        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand('SELECT reservacion.id,plan.nombre as plan,reservacion.codigo,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,reservacion_hab.precio,COUNT(reservacion_hab.ocupacion) as cant,ocupacion.nombre
FROM reservacion,reservacion_hab,ocupacion_hab,ocupacion,plan 
WHERE reservacion.id=reservacion_hab.reservacion and reservacion.plan=plan.id and reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id and reservacion_hab.fecha_entrada LIKE :fecha GROUP BY reservacion.nombre_cliente,ocupacion.nombre ORDER BY reservacion_hab.fecha_entrada asc');
        $command->bindParam(':fecha', $fec);
        $alojamiento = $command->queryAll();


        $nombre = "";

        if ($agencia != '') {
            $command = $connection->createCommand('SELECT reservacion.id,plan.nombre as plan,reservacion.codigo,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,reservacion_hab.precio,COUNT(reservacion_hab.ocupacion) as cant,ocupacion.nombre
FROM reservacion,reservacion_hab,ocupacion_hab,ocupacion,plan 
WHERE reservacion.id=reservacion_hab.reservacion and reservacion.plan=plan.id and reservacion.agencia=:agencia and reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id and reservacion_hab.fecha_entrada LIKE :fecha GROUP BY reservacion.nombre_cliente,ocupacion.nombre ORDER BY reservacion_hab.fecha_entrada asc');
            $command->bindParam(':fecha', $fec);
            $command->bindParam(':agencia', $agencia);
            $alojamiento = $command->queryAll();

            $ag = Agencia::find()->where(['id' => $agencia])->all();
            $nombre = $ag[0]->nombre;
        }
       

        if ($cliente != 0) {
            $command = $connection->createCommand('SELECT reservacion.id,plan.nombre as plan,reservacion.codigo,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,reservacion_hab.precio,COUNT(reservacion_hab.ocupacion) as cant,ocupacion.nombre
FROM reservacion,reservacion_hab,ocupacion_hab,ocupacion,plan 
WHERE  reservacion.id=:cliente and reservacion.plan=plan.id and reservacion.id=reservacion_hab.reservacion and reservacion.agencia=:agencia and reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id and reservacion_hab.fecha_entrada LIKE :fecha GROUP BY reservacion.nombre_cliente,ocupacion.nombre ORDER BY reservacion_hab.fecha_entrada asc');
            $command->bindParam(':fecha', $fec);
            $command->bindParam(':agencia', $agencia);
            $command->bindParam(':cliente', $cliente);
            $alojamiento = $command->queryAll();
        }



        $enviar = array();
        $servicio = array();
        $total = 0;
        $total_serv = 0;



        for ($i = 0; $i < count($alojamiento); $i++) {

            $start_ts = strtotime($alojamiento[$i]["fecha_entrada"]);
            $end_ts = strtotime($alojamiento[$i]["fecha_salida"]);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);



            $id = $alojamiento[$i]["id"];
//            $command = $connection->createCommand('SELECT reservacion_hab.reservacion,reservacion_hab.precio as precio,ocupacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,COUNT(ocupacion.nombre) as cantidad from reservacion_hab,ocupacion,ocupacion_hab where reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id and reservacion_hab.id=:res and reservacion_hab.precio > 0 GROUP BY ocupacion.nombre,reservacion_hab.precio');
//            $command->bindParam(':res', $id);
//            $res = $command->queryAll();
//
//
//
//            $cont = 0;
//            $cant = 0;
//            for ($k = 0; $k < count($res); $k++) {
//
//                $start_ts = strtotime($res[$k]['fecha_entrada']);
//                $end_ts = strtotime($res[$k]['fecha_salida']);
//                $diferencia = $end_ts - $start_ts;
//                $noches = round($diferencia / 86400);
//
//
//
//
//                $total+=$res[$k]['precio'] * $dif_dias * $res[$k]['cantidad'];
//
//                $fe_most = explode('-', $rep_inicial);
//                $fe = $fe_most[0];



            $enviar[count($enviar)] = array(
                'codigo' => $alojamiento[$i]["codigo"],
                'servicio' => 'Alojamiento',
                'nombre' => $alojamiento[$i]["nombre_cliente"],
                'fecha' => $alojamiento[$i]["fecha_entrada"],
                'cant' => $alojamiento[$i]["cant"],
                'ocupacion' => $alojamiento[$i]["nombre"],
                'plan' => $alojamiento[$i]["plan"],
                'precio' => $alojamiento[$i]["precio"],
                'noches' => $dif_dias,
                'subtotal' => Yii::$app->formatter->asDecimal($alojamiento[$i]["precio"] * $dif_dias * $alojamiento[$i]["cant"], 2)
            );
            $total+=$alojamiento[$i]["precio"] * $dif_dias * $alojamiento[$i]["cant"];
        }

        $command2 = $connection->createCommand('SELECT reservacion.nombre_cliente,servicio.nombre as servicio,subservicios.nombre,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,reservacion_servicios.fecha from reservacion,reservacion_servicios,servicio,subservicios where subservicios.id=reservacion_servicios.servicio and reservacion_servicios.estado=1 and subservicios.servicio=servicio.id and reservacion_servicios.reservacion=reservacion.id and reservacion.id=:id GROUP BY reservacion.nombre_cliente,subservicios.nombre,reservacion_servicios.precio,reservacion_servicios.fecha order by reservacion_servicios.fecha asc');
        $command2->bindParam(':id', $id);
        //$command2->bindParam(':fecha', $fec);
        $serv = $command2->queryAll();

 //print_r($serv);die;

        if ($agencia != 0) {
            $command2 = $connection->createCommand('SELECT reservacion.nombre_cliente,servicio.nombre as servicio,subservicios.nombre,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,reservacion_servicios.fecha from reservacion,reservacion_servicios,servicio,subservicios where subservicios.id=reservacion_servicios.servicio and reservacion_servicios.estado=1 and subservicios.servicio=servicio.id and reservacion_servicios.reservacion=reservacion.id and reservacion.id=:id and reservacion.agencia=:agencia  GROUP BY reservacion.nombre_cliente,subservicios.nombre,reservacion_servicios.precio,reservacion_servicios.fecha order by reservacion_servicios.fecha asc');
            $command2->bindParam(':id', $id);
            $command2->bindParam(':agencia', $agencia);
            $serv = $command2->queryAll();
        }



        for ($k = 0; $k < count($serv); $k++) {
            $total_serv+=$serv[$k]['precio'] * $serv[$k]['cant'];

            $ent = explode("-", $serv[$k]['fecha']);
            $entrada = $ent[2] . "-" . $ent[1] . "-" . $ent[0];

            $servicio[count($servicio)] = array(
                'servicio' => $serv[$k]['servicio'],
                'nombre' => $serv[$k]['nombre_cliente'],
                'nombre_servicio' => $serv[$k]['nombre'],
                'cantidad' => $serv[$k]['cant'],
                'precio' => $serv[$k]['precio'],
                'fecha' => $entrada,
                'subtotal' => Yii::$app->formatter->asDecimal($serv[$k]['precio'] * $serv[$k]['cant'], 2)
            );
        }


        $command3 = $connection->createCommand('select pasadia.fecha as fecha,pasadia.nombre as nompasa,servicio.nombre as serv,subservicios.nombre as subsev,sum(pasadia_servicio.cant) as cant,pasadia_servicio.precio as precio from pasadia,pasadia_servicio,servicio,subservicios where pasadia.agencia=:agencia and pasadia.fecha=:fecha and pasadia.id=pasadia_servicio.pasadia and pasadia_servicio.servicio=subservicios.id and subservicios.servicio=servicio.id and pasadia_servicio.incluir=1 and  pasadia.estado=0 group by pasadia_servicio.pasadia,pasadia_servicio.servicio,pasadia_servicio.precio');
        $command3->bindParam(':agencia', $agencia);
        $command3->bindParam(':fecha', $fec);
        $pasadia = $command3->queryAll();

        /* $pasadia = PasadiaServicio::find()->innerJoin('pasadia', $on = 'pasadia_servicio.pasadia=pasadia.id')
          ->where(['pasadia_servicio.incluir' => 1])
          ->andWhere(['pasadia.agencia' => $agencia])
          ->andWhere(['pasadia.estado' => 0])
          ->all(); */

        for ($i = 0; $i < count($pasadia); $i++) {
            $fe = explode("-", $pasadia[$i]['fecha']);
            $fec = $fe[2] . "-" . $fe[1] . "-" . $fe[0];
            $servicio[count($servicio)] = array(
                'servicio' => $pasadia[$i]['serv'],
                'nombre' => $pasadia[$i]['nompasa'],
                'nombre_servicio' => $pasadia[$i]['subsev'],
                'cantidad' => $pasadia[$i]['cant'],
                'precio' => $pasadia[$i]['precio'],
                'fecha' => $fec,
                'subtotal' => Yii::$app->formatter->asDecimal($pasadia[$i]['cant'] * $pasadia[$i]['precio'], 2)
            );
            $total_serv+=$pasadia[$i]['cant'] * $pasadia[$i]['precio'];
        }





        $enviar[count($enviar)] = array(
            'codigo' => '',
            'servicio' => '',
            'nombre' => '',
            'fecha' => '',
            'cant' => '',
            'ocupacion' => '',
            'plan' => '',
            'precio' => '',
            'noches' => 'TOTAL',
            'subtotal' => Yii::$app->formatter->asDecimal($total, 2)
        );
//        print_r($enviar);die;

        $servicio[count($servicio)] = array(
            'servicio' => '',
            'nombre' => '',
            'nombre_servicio' => '',
            'cantidad' => '',
            'precio' => 'TOTAL',
            'fecha' => '',
            'subtotal' => Yii::$app->formatter->asDecimal($total_serv, 2)
        );
//        print_r($servicio);
//           die;

        $mes = array();
        $mes[count($mes)] = array('id' => '01', 'mes' => 'Enero');
        $mes[count($mes)] = array('id' => '02', 'mes' => 'Febrero');
        $mes[count($mes)] = array('id' => '03', 'mes' => 'Marzo');
        $mes[count($mes)] = array('id' => '04', 'mes' => 'Abril');
        $mes[count($mes)] = array('id' => '05', 'mes' => 'Mayo');
        $mes[count($mes)] = array('id' => '06', 'mes' => 'Junio');
        $mes[count($mes)] = array('id' => '07', 'mes' => 'Julio');
        $mes[count($mes)] = array('id' => '08', 'mes' => 'Agosto');
        $mes[count($mes)] = array('id' => '09', 'mes' => 'Septiembre');
        $mes[count($mes)] = array('id' => '10', 'mes' => 'Octubre');
        $mes[count($mes)] = array('id' => '11', 'mes' => 'Noviembre');
        $mes[count($mes)] = array('id' => '12', 'mes' => 'Diciembre');
        $m = '';

        $aux = explode('-', $rep_inicial);

        for ($i = 0; $i < count($mes); $i++) {
            if ($mes[$i]['id'] == $aux[1]) {
                $m = $mes[$i]['mes'];
            }
        }


//print_r($ag[0]->nombre);die;
        return $this->render('agencia-excel', [
                    'alojamientos' => $enviar,
                    'incluidos' => $servicio,
                    'mes' => $m,
                    'agencia' => $nombre,
        ]);
    }

    function actionInfoagencia() {


        $agencia = Yii::$app->request->post('rep_agencia');
        $cliente = Yii::$app->request->post('rep_cliente');
        $rep_inicial = Yii::$app->request->post('rep_inicial');

        $mesexcel = Yii::$app->request->post('rep_inicial');
        $agenciaexcel = Yii::$app->request->post('rep_agencia');

        $fe_en = explode('-', $rep_inicial);
        $rep_inicial = $fe_en[1] . '-' . $fe_en[0];
        //$rep_inicial = $fe_en[1] . '-' . $fe_en[0];

        $fec = "%" . $rep_inicial . "%";        
       


        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand('SELECT reservacion.id,plan.nombre as plan,reservacion.codigo,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,reservacion_hab.precio,COUNT(reservacion_hab.ocupacion) as cant,ocupacion.nombre
FROM reservacion,reservacion_hab,ocupacion_hab,ocupacion,plan 
WHERE reservacion.id=reservacion_hab.reservacion and reservacion.plan=plan.id and reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id and reservacion_hab.fecha_entrada LIKE :fecha GROUP BY reservacion.nombre_cliente,ocupacion.nombre ORDER BY reservacion_hab.fecha_entrada asc');
        $command->bindParam(':fecha', $fec);
        $alojamiento = $command->queryAll();



        if ($agencia != '') {
            $command = $connection->createCommand('SELECT reservacion.id,plan.nombre as plan,reservacion.codigo,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,reservacion_hab.precio,COUNT(reservacion_hab.ocupacion) as cant,ocupacion.nombre
FROM reservacion,reservacion_hab,ocupacion_hab,ocupacion,plan 
WHERE reservacion.id=reservacion_hab.reservacion and reservacion.plan=plan.id and reservacion.agencia=:agencia and reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id and reservacion_hab.fecha_entrada LIKE :fecha GROUP BY reservacion.nombre_cliente,ocupacion.nombre ORDER BY reservacion_hab.fecha_entrada asc');
            $command->bindParam(':fecha', $fec);
            $command->bindParam(':agencia', $agencia);
            $alojamiento = $command->queryAll();
        }

 
        if ($cliente != 0) {
            $command = $connection->createCommand('SELECT reservacion.id,plan.nombre as plan,reservacion.codigo,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,reservacion_hab.precio,COUNT(reservacion_hab.ocupacion) as cant,ocupacion.nombre
FROM reservacion,reservacion_hab,ocupacion_hab,ocupacion,plan 
WHERE  reservacion.id=:cliente and reservacion.plan=plan.id and reservacion.id=reservacion_hab.reservacion and reservacion.agencia=:agencia and reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id and reservacion_hab.fecha_entrada LIKE :fecha GROUP BY reservacion.nombre_cliente,ocupacion.nombre ORDER BY reservacion_hab.fecha_entrada asc');
            $command->bindParam(':fecha', $fec);
            $command->bindParam(':agencia', $agencia);
            $command->bindParam(':cliente', $cliente);
            $alojamiento = $command->queryAll();
        }



        $enviar = array();
        $servicio = array();
        $total = 0;
        $total_serv = 0;



        for ($i = 0; $i < count($alojamiento); $i++) {

            $start_ts = strtotime($alojamiento[$i]["fecha_entrada"]);
            $end_ts = strtotime($alojamiento[$i]["fecha_salida"]);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);
            


            $id = $alojamiento[$i]["id"];
            
//            $command = $connection->createCommand('SELECT reservacion_hab.reservacion,reservacion_hab.precio as precio,ocupacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,COUNT(ocupacion.nombre) as cantidad from reservacion_hab,ocupacion,ocupacion_hab where reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id and reservacion_hab.id=:res and reservacion_hab.precio > 0 GROUP BY ocupacion.nombre,reservacion_hab.precio');
//            $command->bindParam(':res', $id);
//            $res = $command->queryAll();
//
//
//
//            $cont = 0;
//            $cant = 0;
//            for ($k = 0; $k < count($res); $k++) {
//
//                $start_ts = strtotime($res[$k]['fecha_entrada']);
//                $end_ts = strtotime($res[$k]['fecha_salida']);
//                $diferencia = $end_ts - $start_ts;
//                $noches = round($diferencia / 86400);
//
//
//
//
//                $total+=$res[$k]['precio'] * $dif_dias * $res[$k]['cantidad'];
//
//                $fe_most = explode('-', $rep_inicial);
//                $fe = $fe_most[0];



            $enviar[count($enviar)] = array(
                'codigo' => $alojamiento[$i]["codigo"],
                'servicio' => 'Alojamiento',
                'nombre' => $alojamiento[$i]["nombre_cliente"],
                'fecha' => $alojamiento[$i]["fecha_entrada"],
                'cant' => $alojamiento[$i]["cant"],
                'ocupacion' => $alojamiento[$i]["nombre"],
                'plan' => $alojamiento[$i]["plan"],
                'precio' => $alojamiento[$i]["precio"],
                'noches' => $dif_dias,
                'subtotal' => Yii::$app->formatter->asDecimal($alojamiento[$i]["precio"] * $dif_dias * $alojamiento[$i]["cant"], 2)
            );
            $total+=$alojamiento[$i]["precio"] * $dif_dias * $alojamiento[$i]["cant"];
        }

        $command2 = $connection->createCommand('SELECT reservacion.nombre_cliente,servicio.nombre as servicio,subservicios.nombre,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,reservacion_servicios.fecha from reservacion,reservacion_servicios,servicio,subservicios where subservicios.id=reservacion_servicios.servicio and reservacion_servicios.estado=1 and subservicios.servicio=servicio.id and reservacion_servicios.reservacion=reservacion.id and reservacion.id=:id GROUP BY reservacion.nombre_cliente,subservicios.nombre,reservacion_servicios.precio,reservacion_servicios.fecha order by reservacion_servicios.fecha asc');
        $command2->bindParam(':id', $id);
        //$command2->bindParam(':fecha', $fec);
        $serv = $command2->queryAll();

 //print_r($serv);die;

        if ($agencia != 0) {
            $command2 = $connection->createCommand('SELECT reservacion.nombre_cliente,servicio.nombre as servicio,subservicios.nombre,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,reservacion_servicios.fecha from reservacion,reservacion_servicios,servicio,subservicios where subservicios.id=reservacion_servicios.servicio and reservacion_servicios.estado=1 and subservicios.servicio=servicio.id and reservacion_servicios.reservacion=reservacion.id and reservacion.id=:id and reservacion.agencia=:agencia  GROUP BY reservacion.nombre_cliente,subservicios.nombre,reservacion_servicios.precio,reservacion_servicios.fecha order by reservacion_servicios.fecha asc');
            $command2->bindParam(':id', $id);
            $command2->bindParam(':agencia', $agencia);
            $serv = $command2->queryAll();
        }



        for ($k = 0; $k < count($serv); $k++) {
            $total_serv+=$serv[$k]['precio'] * $serv[$k]['cant'];

            $ent = explode("-", $serv[$k]['fecha']);
            $entrada = $ent[2] . "-" . $ent[1] . "-" . $ent[0];

            $servicio[count($servicio)] = array(
                'servicio' => $serv[$k]['servicio'],
                'nombre' => $serv[$k]['nombre_cliente'],
                'nombre_servicio' => $serv[$k]['nombre'],
                'cantidad' => $serv[$k]['cant'],
                'precio' => $serv[$k]['precio'],
                'fecha' => $entrada,
                'subtotal' => Yii::$app->formatter->asDecimal($serv[$k]['precio'] * $serv[$k]['cant'], 2)
            );
        }


        $command3 = $connection->createCommand('select pasadia.fecha as fecha,pasadia.nombre as nompasa,servicio.nombre as serv,subservicios.nombre as subsev,sum(pasadia_servicio.cant) as cant,pasadia_servicio.precio as precio from pasadia,pasadia_servicio,servicio,subservicios where pasadia.agencia=:agencia and pasadia.fecha=:fecha and pasadia.id=pasadia_servicio.pasadia and pasadia_servicio.servicio=subservicios.id and subservicios.servicio=servicio.id and pasadia_servicio.incluir=1 and  pasadia.estado=0 group by pasadia_servicio.pasadia,pasadia_servicio.servicio,pasadia_servicio.precio');
        $command3->bindParam(':agencia', $agencia);
        $command3->bindParam(':fecha', $fec);
        $pasadia = $command3->queryAll();



        /* $pasadia = PasadiaServicio::find()->innerJoin('pasadia', $on = 'pasadia_servicio.pasadia=pasadia.id')
          ->where(['pasadia_servicio.incluir' => 1])
          ->andWhere(['pasadia.agencia' => $agencia])
          ->andWhere(['pasadia.estado' => 0])
          ->all(); */

        for ($i = 0; $i < count($pasadia); $i++) {
            $fe = explode("-", $pasadia[$i]['fecha']);
            $fec = $fe[2] . "-" . $fe[1] . "-" . $fe[0];
            $servicio[count($servicio)] = array(
                'servicio' => $pasadia[$i]['serv'],
                'nombre' => $pasadia[$i]['nompasa'],
                'nombre_servicio' => $pasadia[$i]['subsev'],
                'cantidad' => $pasadia[$i]['cant'],
                'precio' => $pasadia[$i]['precio'],
                'fecha' => $fec,
                'subtotal' => Yii::$app->formatter->asDecimal($pasadia[$i]['cant'] * $pasadia[$i]['precio'], 2)
            );
            $total_serv+=$pasadia[$i]['cant'] * $pasadia[$i]['precio'];
        }




        $enviar[count($enviar)] = array(
            'codigo' => '',
            'servicio' => '',
            'nombre' => '',
            'fecha' => '',
            'cant' => '',
            'ocupacion' => '',
            'plan' => '',
            'precio' => '',
            'noches' => 'TOTAL',
            'subtotal' => Yii::$app->formatter->asDecimal($total, 2)
        );
//        print_r($enviar);die;

        $servicio[count($servicio)] = array(
            'servicio' => '',
            'nombre' => '',
            'nombre_servicio' => '',
            'cantidad' => '',
            'precio' => 'TOTAL',
            'fecha' => '',
            'subtotal' => Yii::$app->formatter->asDecimal($total_serv, 2)
        );
//        print_r($mesexcel);
//           die;



        return $this->render('agencia', [
                    'enviar' => $enviar,
                    'serv' => $servicio,
                    'mesexcel' => $mesexcel,
                    'agenciaexcel' => $agenciaexcel,
                    'clienteexcel' => $cliente,
        ]);
    }

    function actionGastos() {
        $entrada = '';
        $salida = '';
        $id_gastos = '';
        return $this->render('gastos', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'id_gastos' => $id_gastos,
        ]);
    }

    function actionInfogastos() {
        $entrada = Yii::$app->request->post('gastos_entrada');
        $salida = Yii::$app->request->post('gastos_salida');

        $id_gastos = Yii::$app->request->post('gastos');


        $fecha = explode('-', $entrada);
        $entrada = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];


        $fecha = explode('-', $salida);
        $salida = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        $connection = \Yii::$app->db;
        $connection->open();
        $command = $connection->createCommand('select gastos.id as gastos,gastos.nombre as servicio,SUM(addgastos.cant)as cant,SUM(addgastos.importe)as imp,unidad.nombre as unidad from gastos,addgastos,unidad where addgastos.fecha >=:entrada and addgastos.fecha <=:salida and addgastos.gastos=gastos.id and addgastos.unidad=unidad.id GROUP BY gastos.nombre,unidad.nombre ORDER BY gastos.nombre asc');
        $command->bindParam(':entrada', $entrada);
        $command->bindParam(':salida', $salida);
        $gastos = $command->queryAll();



        if ($id_gastos != "") {
            $connection = \Yii::$app->db;
            $connection->open();
            $command = $connection->createCommand('SELECT * from addgastos where fecha >=:entrada AND fecha <=:salida and gastos=:gastos ORDER BY fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':gastos', $id_gastos);
            $gastos = $command->queryAll();
        }





        return $this->render('gastos', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'gastos' => $gastos,
                    'id_gastos' => $id_gastos,
        ]);
    }

    function actionGastosExcel() {
        $entrada = Yii::$app->request->post('gastos_entrada');
        $salida = Yii::$app->request->post('gastos_salida');

        $id_gastos = Yii::$app->request->post('gastos_gastos');


//        $fecha = explode('-', $entrada);
//        $entrada = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
//
//
//        $fecha = explode('-', $salida);
//        $salida = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        $connection = \Yii::$app->db;
        $connection->open();
        $command = $connection->createCommand('select gastos.id as gastos,gastos.nombre as servicio,SUM(addgastos.cant)as cant,SUM(addgastos.importe)as imp,unidad.nombre as unidad from gastos,addgastos,unidad where addgastos.fecha >=:entrada and addgastos.fecha <=:salida and addgastos.gastos=gastos.id and addgastos.unidad=unidad.id GROUP BY gastos.nombre,unidad.nombre ORDER BY gastos.nombre asc');
        $command->bindParam(':entrada', $entrada);
        $command->bindParam(':salida', $salida);
        $gastos = $command->queryAll();

        if ($id_gastos != "") {
            $connection = \Yii::$app->db;
            $connection->open();
            $command = $connection->createCommand('SELECT * from addgastos where fecha >=:entrada AND fecha <=:salida and gastos=:gastos ORDER BY fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':gastos', $id_gastos);
            $gastos = $command->queryAll();
        }



        // print_r($gastos);die;

        return $this->render('gastos-excel', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'gastos' => $gastos,
                    'id_gastos' => $id_gastos,
        ]);
    }

    function actionIngresos() {
        $entrada = '';
        $salida = '';
        $servicios = '';
        $subservicios = '';
        return $this->render('ingresos', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'servicios' => $servicios,
                    'subservicios' => $subservicios,
        ]);
    }

    function actionInfoingresos() {
        $entrada = Yii::$app->request->post('ing_entrada');
        $salida = Yii::$app->request->post('ing_salida');
        $servicios = Yii::$app->request->post('rep_servicios');
        $subservicios = Yii::$app->request->post('rep_subservicios');





        $fecha = explode('-', $entrada);
        $entrada = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];


        $fecha = explode('-', $salida);
        $salida = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        $connection = \Yii::$app->db;
        $connection->open();
        $command = $connection->createCommand('SELECT reservacion.id,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,agencia.nombre as agencia, COUNT(habitacion.nombre) as canthab,habitacion.nombre as hab,SUM(reservacion_hab.precio) as precio,reservacion.canthab as hab FROM reservacion,reservacion_hab,habitacion,agencia where reservacion.fecha_entrada >=:entrada and reservacion.fecha_entrada <=:salida and reservacion_hab.reservacion=reservacion.id and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and reservacion_hab.precio>0  GROUP BY reservacion.nombre_cliente ORDER BY reservacion_hab.fecha_entrada ASC');
        $command->bindParam(':entrada', $entrada);
        $command->bindParam(':salida', $salida);
        $ing = $command->queryAll();




        $resultado = array();
        $dia = array();
        $ing_total = 0;



        for ($i = 0; $i < count($ing); $i++) {

            $start_ts = strtotime($ing[$i]['fecha_entrada']);
            $end_ts = strtotime($ing[$i]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $noches = round($diferencia / 86400);



            //SELECT sum(cant*precio)from reservacion_servicios

            $command = $connection->createCommand('SELECT sum(cant*precio) as imp_serv from reservacion_servicios where reservacion=:id and estado < 2');
            $command->bindParam(':id', $ing[$i]['id']);
            $imp_servicios = $command->queryAll();
//           print_r($imp_servicios[0]['imp_serv']);die;
            //$ing_total+=$ing[$i]['precio'] * $noches + $imp_servicios[0]['imp_serv'];

            $fe = explode('-', $ing[$i]['fecha_entrada']);

            $imp2 = $imp_servicios[0]['imp_serv'];
            //print_r($imp);die;
            if ($imp2 == NULL) {
                $imp2 = 0;
            }

            $resultado[count($resultado)] = array(
                'nombre' => $ing[$i]['nombre_cliente'],
                'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                'agencia' => $ing[$i]['agencia'],
                'noches' => $noches,
                'canthab' => $ing[$i]['hab'],
                'imp_aloj' => $ing[$i]['precio'] * $noches,
                'imp_ser' => $imp2,
            );
        }



        $command = $connection->createCommand('select pasadia.id, pasadia.nombre, pasadia.fecha,agencia.nombre as agencia from pasadia,pasadia_servicio,agencia where pasadia.fecha BETWEEN :entrada and :salida and pasadia.agencia=agencia.id GROUP BY pasadia.id,pasadia.nombre ORDER BY pasadia.fecha');
        $command->bindParam(':entrada', $entrada);
        $command->bindParam(':salida', $salida);
        $pasadia = $command->queryAll();


        for ($i = 0; $i < count($pasadia); $i++) {

            $command = $connection->createCommand('SELECT SUM(pasadia_servicio.cant*pasadia_servicio.precio) as imp from pasadia_servicio where pasadia_servicio.pasadia=:id');
            $command->bindParam(':id', $pasadia[$i]['id']);
            $imp = $command->queryAll();

            $fe = explode('-', $pasadia[$i]['fecha']);

            $dia[count($dia)] = array(
                'nombre' => $pasadia[$i]['nombre'],
                'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                'agencia' => $pasadia[$i]['agencia'],
                'noches' => "",
                'canthab' => "",
                'imp_aloj' => "",
                'imp_ser' => $imp[0]['imp'],
            );
        }



        //FALTA BUSCAR LOS INGRESOS POR SERVICIOS EN ESE RANGO DE FECHA Y SUMARFLOS EN EL REP
//        $connection = \Yii::$app->db;
//        $connection->open();
//        $command = $connection->createCommand('select gastos.nombre as servicio,SUM(addgastos.cant)as cant,SUM(addgastos.importe)as imp,unidad.nombre as unidad from gastos,addgastos,unidad where addgastos.fecha >=:entrada and addgastos.fecha <=:salida and addgastos.gastos=gastos.id and addgastos.unidad=unidad.id GROUP BY gastos.nombre,unidad.nombre ORDER BY gastos.nombre asc');
//        $command->bindParam(':entrada', $entrada);
//        $command->bindParam(':salida', $salida);
//        $gastos = $command->queryAll();
//
//        $gastos_totales = 0;
//
//        for ($i = 0; $i < count($gastos); $i++) {
//            $gastos_totales+=$gastos[$i]['imp'];
//        }



        if ($servicios != '' && $servicios != 0) {


            $connection = \Yii::$app->db;
            $connection->open();
            $command = $connection->createCommand('select reservacion.nombre_cliente,subservicios.nombre as servicio,sum(reservacion_servicios.cant) as cant,reservacion_servicios.precio,reservacion_servicios.fecha,habitacion.nombre as hab,agencia.nombre as agencia,servicio.nombre as nom_serv,reservacion.canthab as hab from reservacion_servicios,reservacion,subservicios,habitacion,agencia,servicio WHERE reservacion.id = reservacion_servicios.reservacion AND reservacion.agencia = agencia.id AND reservacion_servicios.hab = habitacion.id AND reservacion_servicios.servicio = subservicios.id AND subservicios.servicio=servicio.id AND servicio.id =:ser AND reservacion_servicios.fecha BETWEEN :entrada AND :salida and reservacion_servicios.estado < 2 GROUP BY subservicios.nombre ,reservacion_servicios.precio,agencia.nombre,reservacion_servicios.fecha ORDER BY reservacion_servicios.fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':ser', $servicios);
            $ing = $command->queryAll();

            $resultado = array();
            $dia = array();

            for ($k = 0; $k < count($ing); $k++) {

                $fe = explode('-', $ing[$k]['fecha']);



                $resultado[$k] = array(
                    'nombre' => $ing[$k]['nom_serv'] . ' - ' . $ing[$k]['servicio'],
                    'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                    'agencia' => $ing[$k]['agencia'],
                    'noches' => '',
                    'canthab' => $ing[$k]['cant'],
                    'imp_aloj' => '',
                    'imp_ser' => $ing[$k]['cant'] * $ing[$k]['precio'],
                );
            }


            $command = $connection->createCommand('select pasadia.nombre,subservicios.nombre as servicio,sum(pasadia_servicio.cant) as cant,pasadia_servicio.precio,pasadia.fecha,agencia.nombre as agencia,servicio.nombre as nom_serv from pasadia_servicio,pasadia,subservicios,agencia,servicio WHERE pasadia.id = pasadia_servicio.pasadia AND pasadia.agencia = agencia.id AND pasadia_servicio.servicio = subservicios.id AND subservicios.servicio=servicio.id AND servicio.id =:ser AND pasadia.fecha BETWEEN :entrada AND :salida GROUP BY subservicios.nombre ,pasadia_servicio.precio,agencia.nombre,pasadia.fecha ORDER BY pasadia.fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':ser', $servicios);
            $pasadia = $command->queryAll();

            for ($k = 0; $k < count($pasadia); $k++) {

                $fe = explode('-', $pasadia[$k]['fecha']);

                $dia[$k] = array(
                    'nombre' => $pasadia[$k]['nom_serv'] . ' - ' . $pasadia[$k]['servicio'],
                    'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                    'agencia' => $pasadia[$k]['agencia'],
                    'noches' => '',
                    'canthab' => $pasadia[$k]['cant'],
                    'imp_aloj' => '',
                    'imp_ser' => $pasadia[$k]['cant'] * $pasadia[$k]['precio'],
                );
            }
        }


        if ($subservicios != 0) {

            $connection = \Yii::$app->db;
            $connection->open();
            $command = $connection->createCommand('select reservacion.nombre_cliente,subservicios.nombre as servicio,sum(reservacion_servicios.cant) as cant,reservacion_servicios.precio,reservacion_servicios.fecha,habitacion.nombre as hab,agencia.nombre as agencia,servicio.nombre as nom_serv,reservacion.canthab as hab from reservacion_servicios,reservacion,subservicios,habitacion,agencia,servicio WHERE reservacion.id = reservacion_servicios.reservacion AND reservacion.agencia = agencia.id AND reservacion_servicios.hab = habitacion.id AND reservacion_servicios.servicio = subservicios.id AND subservicios.servicio=servicio.id AND servicio.id =:ser AND subservicios.id=:sub AND reservacion_servicios.fecha BETWEEN :entrada AND :salida and reservacion_servicios.estado < 2 GROUP BY subservicios.nombre ,reservacion_servicios.precio,agencia.nombre,reservacion_servicios.fecha ORDER BY reservacion_servicios.fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':ser', $servicios);
            $command->bindParam(':sub', $subservicios);
            $ing = $command->queryAll();


            $resultado = array();
            $dia = array();

            for ($k = 0; $k < count($ing); $k++) {
                $fec = explode("-", $ing[$k]['fecha']);

                $resultado[$k] = array(
                    'nombre' => $ing[$k]['nom_serv'] . ' - ' . $ing[$k]['servicio'],
                    'fecha' => $fec[2] . "-" . $fec[1] . "-" . $fec[0],
                    'agencia' => $ing[$k]['agencia'],
                    'noches' => '',
                    'canthab' => $ing[$k]['cant'],
                    'imp_aloj' => '',
                    'imp_ser' => $ing[$k]['cant'] * $ing[$k]['precio'],
                );
            }


            $command = $connection->createCommand('select pasadia.nombre,subservicios.nombre as servicio,sum(pasadia_servicio.cant) as cant,pasadia_servicio.precio,pasadia.fecha,agencia.nombre as agencia,servicio.nombre as nom_serv from pasadia_servicio,pasadia,subservicios,agencia,servicio WHERE pasadia.id = pasadia_servicio.pasadia AND pasadia.agencia = agencia.id AND pasadia_servicio.servicio = subservicios.id AND subservicios.servicio=servicio.id AND servicio.id =:ser AND subservicios.id=:sub AND pasadia.fecha BETWEEN :entrada AND :salida GROUP BY subservicios.nombre ,pasadia_servicio.precio,agencia.nombre,pasadia.fecha ORDER BY pasadia.fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':ser', $servicios);
            $command->bindParam(':sub', $subservicios);
            $pasadia = $command->queryAll();


            for ($k = 0; $k < count($pasadia); $k++) {
                $fec = explode("-", $pasadia[$k]['fecha']);

                $dia[count($dia)] = array(
                    'nombre' => $pasadia[$k]['nom_serv'] . ' - ' . $pasadia[$k]['servicio'],
                    'fecha' => $fec[2] . "-" . $fec[1] . "-" . $fec[0],
                    'agencia' => $pasadia[$k]['agencia'],
                    'noches' => '',
                    'canthab' => $pasadia[$k]['cant'],
                    'imp_aloj' => '',
                    'imp_ser' => $pasadia[$k]['cant'] * $pasadia[$k]['precio'],
                );
            }
        }





        // $neta = $ing_total - $gastos_totales;
//        $resultado[count($resultado)] = array(
//            'nombre' => '',
//            'fecha' => '',
//            'agencia' => '',
//            'noches' => '',
//            'canthab' => $ing_total,
//            'imp_aloj' => $gastos_totales,
//            'imp_ser' => $neta,
//        );




        return $this->render('ingresos', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'servicios' => $servicios,
                    'subservicios' => $subservicios,
                    'resultado' => $resultado,
                    'pasadia' => $dia,
        ]);
    }

    function actionIngresosExcel() {

        $entrada = Yii::$app->request->post('entrada');
        $salida = Yii::$app->request->post('salida');
        $servicios = Yii::$app->request->post('servicio');
        $subservicios = Yii::$app->request->post('subservicios');



        $connection = \Yii::$app->db;
        $connection->open();
        $command = $connection->createCommand('SELECT reservacion.id,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,agencia.nombre as agencia, COUNT(habitacion.nombre) as canthab,habitacion.nombre as hab,SUM(reservacion_hab.precio) as precio,reservacion.canthab as hab FROM reservacion,reservacion_hab,habitacion,agencia where reservacion_hab.fecha_entrada >=:entrada and reservacion_hab.fecha_entrada <=:salida and reservacion_hab.reservacion=reservacion.id and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and reservacion_hab.precio>0  GROUP BY reservacion.nombre_cliente ORDER BY reservacion_hab.fecha_entrada ASC');
        $command->bindParam(':entrada', $entrada);
        $command->bindParam(':salida', $salida);
        $ing = $command->queryAll();


        $resultado = array();
        $dia = array();
        $ing_total = 0;



        for ($i = 0; $i < count($ing); $i++) {

            $start_ts = strtotime($ing[$i]['fecha_entrada']);
            $end_ts = strtotime($ing[$i]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $noches = round($diferencia / 86400);



            //SELECT sum(cant*precio)from reservacion_servicios

            $command = $connection->createCommand('SELECT sum(cant*precio) as imp_serv from reservacion_servicios where reservacion=:id and estado < 2');
            $command->bindParam(':id', $ing[$i]['id']);
            $imp_servicios = $command->queryAll();
//           print_r($imp_servicios[0]['imp_serv']);die;

            $fe = explode('-', $ing[$i]['fecha_entrada']);

            $ser = $imp_servicios[0]['imp_serv'];
            if ($imp_servicios[0]['imp_serv'] == "") {
                $ser = 0;
            }

            $resultado[count($resultado)] = array(
                'nombre' => $ing[$i]['nombre_cliente'],
                'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                'agencia' => $ing[$i]['agencia'],
                'noches' => $noches,
                'canthab' => $ing[$i]['hab'],
                'imp_aloj' => $ing[$i]['precio'] * $noches,
                'imp_ser' => $ser,
            );
        }

        $command = $connection->createCommand('select pasadia.id, pasadia.nombre, pasadia.fecha,agencia.nombre as agencia from pasadia,pasadia_servicio,agencia where pasadia.fecha BETWEEN :entrada and :salida and pasadia.agencia=agencia.id GROUP BY pasadia.id,pasadia.nombre ORDER BY pasadia.fecha');
        $command->bindParam(':entrada', $entrada);
        $command->bindParam(':salida', $salida);
        $pasadia = $command->queryAll();


        for ($i = 0; $i < count($pasadia); $i++) {

            $command = $connection->createCommand('SELECT SUM(pasadia_servicio.cant*pasadia_servicio.precio) as imp from pasadia_servicio where pasadia_servicio.pasadia=:id');
            $command->bindParam(':id', $pasadia[$i]['id']);
            $imp = $command->queryAll();

            $fe = explode('-', $pasadia[$i]['fecha']);

            $dia[count($dia)] = array(
                'nombre' => $pasadia[$i]['nombre'],
                'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                'agencia' => $pasadia[$i]['agencia'],
                'noches' => "",
                'canthab' => "",
                'imp_aloj' => 0,
                'imp_ser' => $imp[0]['imp'],
            );
        }




        //FALTA BUSCAR LOS INGRESOS POR SERVICIOS EN ESE RANGO DE FECHA Y SUMARFLOS EN EL REP
//        $connection = \Yii::$app->db;
//        $connection->open();
//        $command = $connection->createCommand('select gastos.nombre as servicio,SUM(addgastos.cant)as cant,SUM(addgastos.importe)as imp,unidad.nombre as unidad from gastos,addgastos,unidad where addgastos.fecha >=:entrada and addgastos.fecha <=:salida and addgastos.gastos=gastos.id and addgastos.unidad=unidad.id GROUP BY gastos.nombre,unidad.nombre ORDER BY gastos.nombre asc');
//        $command->bindParam(':entrada', $entrada);
//        $command->bindParam(':salida', $salida);
//        $gastos = $command->queryAll();
//
//        $gastos_totales = 0;
//
//        for ($i = 0; $i < count($gastos); $i++) {
//            $gastos_totales+=$gastos[$i]['imp'];
//        }



        if ($servicios != '' && $servicios != 0) {



            $connection = \Yii::$app->db;
            $connection->open();
            $command = $connection->createCommand('select reservacion.nombre_cliente,subservicios.nombre as servicio,sum(reservacion_servicios.cant) as cant,reservacion_servicios.precio,reservacion_servicios.fecha,habitacion.nombre as hab,agencia.nombre as agencia,servicio.nombre as nom_serv,reservacion.canthab as hab from reservacion_servicios,reservacion,subservicios,habitacion,agencia,servicio WHERE reservacion.id = reservacion_servicios.reservacion AND reservacion.agencia = agencia.id AND reservacion_servicios.hab = habitacion.id AND reservacion_servicios.servicio = subservicios.id AND subservicios.servicio=servicio.id AND servicio.id =:ser AND reservacion_servicios.fecha BETWEEN :entrada AND :salida and reservacion_servicios.estado < 2 GROUP BY subservicios.nombre ,reservacion_servicios.precio,agencia.nombre,reservacion_servicios.fecha ORDER BY reservacion_servicios.fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':ser', $servicios);
            $ing = $command->queryAll();




            $resultado = array();
            $dia = array();

            for ($k = 0; $k < count($ing); $k++) {

                $fe = explode('-', $ing[$k]['fecha']);

                $resultado[$k] = array(
                    'nombre' => $ing[$k]['nom_serv'] . ' - ' . $ing[$k]['servicio'],
                    'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                    'agencia' => $ing[$k]['agencia'],
                    'noches' => '',
                    'canthab' => $ing[$k]['cant'],
                    'imp_aloj' => 0,
                    'imp_ser' => $ing[$k]['cant'] * $ing[$k]['precio'],
                );
            }

            $command = $connection->createCommand('select pasadia.nombre,subservicios.nombre as servicio,sum(pasadia_servicio.cant) as cant,pasadia_servicio.precio,pasadia.fecha,agencia.nombre as agencia,servicio.nombre as nom_serv from pasadia_servicio,pasadia,subservicios,agencia,servicio WHERE pasadia.id = pasadia_servicio.pasadia AND pasadia.agencia = agencia.id AND pasadia_servicio.servicio = subservicios.id AND subservicios.servicio=servicio.id AND servicio.id =:ser AND pasadia.fecha BETWEEN :entrada AND :salida GROUP BY subservicios.nombre ,pasadia_servicio.precio,agencia.nombre,pasadia.fecha ORDER BY pasadia.fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':ser', $servicios);
            $pasadia = $command->queryAll();

            for ($k = 0; $k < count($pasadia); $k++) {

                $fe = explode('-', $pasadia[$k]['fecha']);

                $dia[$k] = array(
                    'nombre' => $pasadia[$k]['nom_serv'] . ' - ' . $pasadia[$k]['servicio'],
                    'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                    'agencia' => $pasadia[$k]['agencia'],
                    'noches' => '',
                    'canthab' => $pasadia[$k]['cant'],
                    'imp_aloj' => 0,
                    'imp_ser' => $pasadia[$k]['cant'] * $pasadia[$k]['precio'],
                );
            }
        }

        if ($subservicios != 0) {

            $connection = \Yii::$app->db;
            $connection->open();
            $command = $connection->createCommand('select reservacion.nombre_cliente,subservicios.nombre as servicio,sum(reservacion_servicios.cant) as cant,reservacion_servicios.precio,reservacion_servicios.fecha,habitacion.nombre as hab,agencia.nombre as agencia,servicio.nombre as nom_serv,reservacion.canthab as hab from reservacion_servicios,reservacion,subservicios,habitacion,agencia,servicio WHERE reservacion.id = reservacion_servicios.reservacion AND reservacion.agencia = agencia.id AND reservacion_servicios.hab = habitacion.id AND reservacion_servicios.servicio = subservicios.id AND subservicios.servicio=servicio.id AND servicio.id =:ser AND subservicios.id=:sub AND reservacion_servicios.fecha BETWEEN :entrada AND :salida and reservacion_servicios.estado < 2 GROUP BY subservicios.nombre ,reservacion_servicios.precio,agencia.nombre,reservacion_servicios.fecha ORDER BY reservacion_servicios.fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':ser', $servicios);
            $command->bindParam(':sub', $subservicios);
            $ing = $command->queryAll();




            $resultado = array();

            for ($k = 0; $k < count($ing); $k++) {
                $fe = explode('-', $ing[$k]['fecha']);

                $resultado[$k] = array(
                    'nombre' => $ing[$k]['nom_serv'] . ' - ' . $ing[$k]['servicio'],
                    'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                    'agencia' => $ing[$k]['agencia'],
                    'noches' => '',
                    'canthab' => $ing[$k]['cant'],
                    'imp_aloj' => 0,
                    'imp_ser' => $ing[$k]['cant'] * $ing[$k]['precio'],
                );
            }

            $command = $connection->createCommand('select pasadia.nombre,subservicios.nombre as servicio,sum(pasadia_servicio.cant) as cant,pasadia_servicio.precio,pasadia.fecha,agencia.nombre as agencia,servicio.nombre as nom_serv from pasadia_servicio,pasadia,subservicios,agencia,servicio WHERE pasadia.id = pasadia_servicio.pasadia AND pasadia.agencia = agencia.id AND pasadia_servicio.servicio = subservicios.id AND subservicios.servicio=servicio.id AND servicio.id =:ser AND subservicios.id=:sub AND pasadia.fecha BETWEEN :entrada AND :salida GROUP BY subservicios.nombre ,pasadia_servicio.precio,agencia.nombre,pasadia.fecha ORDER BY pasadia.fecha ASC');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':ser', $servicios);
            $command->bindParam(':sub', $subservicios);
            $pasadia = $command->queryAll();


            for ($k = 0; $k < count($pasadia); $k++) {
                $fec = explode("-", $pasadia[$k]['fecha']);

                $dia[$k] = array(
                    'nombre' => $pasadia[$k]['nom_serv'] . ' - ' . $pasadia[$k]['servicio'],
                    'fecha' => $fec[2] . "-" . $fec[1] . "-" . $fec[0],
                    'agencia' => $pasadia[$k]['agencia'],
                    'noches' => '',
                    'canthab' => $pasadia[$k]['hab'],
                    'imp_aloj' => 0,
                    'imp_ser' => $pasadia[$k]['cant'] * $pasadia[$k]['precio'],
                );
            }
        }





//        $neta = $ing_total - $gastos_totales;
//        $resultado[count($resultado)] = array(
//            'nombre' => '',
//            'fecha' => '',
//            'agencia' => '',
//            'noches' => '',
//            'canthab' => $ing_total,
//            'imp_aloj' => $gastos_totales,
//            'imp_ser' => $neta,
//        );




        return $this->render('ingresos-excel', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'servicios' => $servicios,
                    'subservicios' => $subservicios,
                    'resultado' => $resultado,
                    'pasadia' => $dia,
        ]);
    }

    function actionGeneral() {
        $entrada = '';
        $salida = '';
        $agencia = '';
        $servicio = '';
        $subservicio = '';
        $incluir = '';
        $result = array();
        return $this->render('general', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'agencia' => $agencia,
                    'servicio' => $servicio,
                    'subservicio' => $subservicio,
                    'incluir' => $incluir,
                    'result' => $result,
        ]);
    }

    function actionInfogeneral() {

        $entrada = Yii::$app->request->post('general_entrada');
        $salida = Yii::$app->request->post('general_salida');
        $agencia = Yii::$app->request->post('general_agencia');
        $serv = Yii::$app->request->post('general_servicios');
        $subserv = Yii::$app->request->post('general_subservicios');
        $incluir = Yii::$app->request->post('incluir');



        $fecha = explode('-', $entrada);
        $entrada = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];


        $fecha = explode('-', $salida);
        $salida = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        $connection = \Yii::$app->db;
        $connection->open();
        $command = $connection->createCommand('SELECT reservacion.id,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,agencia.nombre as agencia, COUNT(habitacion.nombre) as canthab,habitacion.nombre as hab, sum(reservacion_hab.precio) as precio FROM reservacion,reservacion_hab,habitacion,agencia where reservacion_hab.fecha_entrada >=:entrada and reservacion_hab.fecha_entrada <=:salida and reservacion_hab.reservacion=reservacion.id  and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and reservacion_hab.precio>0  GROUP BY reservacion.nombre_cliente');
        $command->bindParam(':entrada', $entrada);
        $command->bindParam(':salida', $salida);
        $alojamiento = $command->queryAll();





        if ($agencia != 'Agencia') {
            $command = $connection->createCommand('SELECT reservacion.id,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,agencia.nombre as agencia, COUNT(habitacion.nombre) as canthab,habitacion.nombre as hab, sum(reservacion_hab.precio) as precio FROM reservacion,reservacion_hab,habitacion,agencia where reservacion_hab.fecha_entrada >=:entrada and reservacion_hab.fecha_entrada <=:salida and reservacion_hab.reservacion=reservacion.id  and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and agencia.id=:agencia and reservacion_hab.precio>0  GROUP BY reservacion.nombre_cliente');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':agencia', $agencia);
            $alojamiento = $command->queryAll();
        }



        $result = array();


        $fecha = explode('-', $entrada);
        $entrada1 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];


        $fecha = explode('-', $salida);
        $salida1 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        for ($i = 0; $i < count($alojamiento); $i++) {
            $id = $alojamiento[$i]['id'];
            $imp = 0;


            $servicio = array();

            $command = $connection->createCommand('SELECT reservacion_servicios.id,servicio.nombre as serv,subservicios.nombre as subserv, COUNT(subservicios.nombre) as cantsubserv,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,SUM(reservacion_servicios.precio*reservacion_servicios.cant)as imp  FROM reservacion_servicios,servicio,subservicios WHERE reservacion_servicios.reservacion=:id and reservacion_servicios.estado=0 and reservacion_servicios.servicio=subservicios.id and subservicios.servicio=servicio.id  GROUP BY subservicios.nombre,reservacion_servicios.precio');
            $command->bindParam(':id', $id);
            $servicio = $command->queryAll();






            if ($serv != '' && $serv != 0) {
                $command = $connection->createCommand('SELECT
	reservacion_servicios.id,
	servicio.nombre AS serv,
	subservicios.nombre AS subserv,
	COUNT(subservicios.nombre) AS cantsubserv,
	SUM(reservacion_servicios.cant) AS cant,
	reservacion_servicios.precio,
	SUM(
		reservacion_servicios.precio * reservacion_servicios.cant
	) AS imp
FROM
	reservacion_servicios,
	servicio,
	subservicios
WHERE reservacion_servicios.reservacion=:id
AND reservacion_servicios.estado=0
AND reservacion_servicios.servicio=subservicios.id
AND subservicios.servicio=servicio.id
AND servicio.id=:sub
GROUP BY
	subservicios.nombre,
	reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $command->bindParam(':sub', $serv);
                $servicio = $command->queryAll();
            }


            if ($subserv != '' && $subserv != 0) {
                $command = $connection->createCommand('SELECT
	reservacion_servicios.id,
	servicio.nombre AS serv,
	subservicios.nombre AS subserv,
	COUNT(subservicios.nombre) AS cantsubserv,
	SUM(reservacion_servicios.cant) AS cant,
	reservacion_servicios.precio,
	SUM(
		reservacion_servicios.precio * reservacion_servicios.cant
	) AS imp
FROM
	reservacion_servicios,
	servicio,
	subservicios
WHERE reservacion_servicios.reservacion=:id
AND reservacion_servicios.estado=0
AND reservacion_servicios.servicio=subservicios.id
AND subservicios.id=:sub
AND subservicios.servicio=servicio.id
AND servicio.id=:ser
GROUP BY
	subservicios.nombre,
	reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $command->bindParam(':ser', $serv);
                $command->bindParam(':sub', $subserv);
                $servicio = $command->queryAll();
            }



//            if ($incluir == 1) {
//                $command = $connection->createCommand('SELECT reservacion_servicios.id,servicio.nombre as serv,subservicios.nombre as subserv, COUNT(subservicios.nombre) as cantsubserv,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,SUM(reservacion_servicios.precio*reservacion_servicios.cant)as imp  FROM reservacion_servicios,servicio,subservicios WHERE reservacion_servicios.reservacion=:id and reservacion_servicios.estado=1 and reservacion_servicios.servicio=subservicios.id and subservicios.servicio=servicio.id  GROUP BY subservicios.nombre,reservacion_servicios.precio');
//                $command->bindParam(':id', $id);
//                $servicio = $command->queryAll();
//            }

            if ($incluir == 1) {

                $command = $connection->createCommand('SELECT reservacion_servicios.id,servicio.nombre as serv,subservicios.nombre as subserv, COUNT(subservicios.nombre) as cantsubserv,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,SUM(reservacion_servicios.precio*reservacion_servicios.cant)as imp  FROM reservacion_servicios,servicio,subservicios WHERE reservacion_servicios.reservacion=:id and reservacion_servicios.estado=1 and reservacion_servicios.servicio=subservicios.id and subservicios.servicio=servicio.id  GROUP BY subservicios.nombre,reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $servicio = $command->queryAll();
            }

            if ($incluir == 1 && ($serv != '' && $serv != 0)) {



                $command = $connection->createCommand('SELECT
	reservacion_servicios.id,
	servicio.nombre AS serv,
	subservicios.nombre AS subserv,
	COUNT(subservicios.nombre) AS cantsubserv,
	SUM(reservacion_servicios.cant) AS cant,
	reservacion_servicios.precio,
	SUM(
		reservacion_servicios.precio * reservacion_servicios.cant
	) AS imp
FROM
	reservacion_servicios,
	servicio,
	subservicios
WHERE
	reservacion_servicios.reservacion =:id
AND reservacion_servicios.estado = 1
AND reservacion_servicios.servicio = subservicios.id
AND subservicios.servicio = servicio.id
AND servicio.id=:sub
GROUP BY
	subservicios.nombre,
	reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $command->bindParam(':sub', $serv);
                $servicio = $command->queryAll();
                // print_r($servicio);
            }

            if ($incluir == 1 && ($subserv != '' && $subserv != 0)) {
                $command = $connection->createCommand('SELECT reservacion_servicios.id,servicio.nombre as serv,subservicios.nombre as subserv, COUNT(subservicios.nombre) as cantsubserv,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,SUM(reservacion_servicios.precio*reservacion_servicios.cant)as imp  FROM reservacion_servicios,servicio,subservicios WHERE reservacion_servicios.reservacion=:id and reservacion_servicios.estado=1 and reservacion_servicios.servicio=:sub and reservacion_servicios.servicio=subservicios.id and subservicios.servicio=servicio.id  GROUP BY subservicios.nombre,reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $command->bindParam(':sub', $subserv);
                $servicio = $command->queryAll();
            }



            $start_ts = strtotime($alojamiento[$i]['fecha_entrada']);
            $end_ts = strtotime($alojamiento[$i]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $noches = round($diferencia / 86400);

            $imp = $noches * $alojamiento[$i]['precio'];

            $result[count($result)] = array(
                'cliente' => $alojamiento[$i]['nombre_cliente'],
                'inicial' => $entrada1,
                'final' => $salida1,
                'agencia' => $alojamiento[$i]['agencia'],
                'servicio' => '',
                'subservicio' => '',
                'cantsubserv' => '',
                'canthab' => $alojamiento[$i]['canthab'],
                'precio' => $alojamiento[$i]['precio'],
                'noches' => $noches,
                'imp_aloj' => Yii::$app->formatter->asDecimal($imp, 2),
                'imp_serv' => '',
            );


            for ($k = 0; $k < count($servicio); $k++) {

                $result[count($result)] = array(
                    'cliente' => $alojamiento[$i]['nombre_cliente'],
                    'inicial' => $entrada1,
                    'final' => $salida1,
                    'agencia' => $alojamiento[$i]['agencia'],
                    'servicio' => $servicio[$k]['serv'],
                    'subservicio' => $servicio[$k]['subserv'],
                    'cantsubserv' => $servicio[$k]['cant'],
                    'canthab' => $alojamiento[$i]['canthab'],
                    'precio' => $servicio[$k]['precio'],
                    'noches' => '',
                    'imp_aloj' => '',
                    'imp_serv' => Yii::$app->formatter->asDecimal($servicio[$k]['imp'], 2),
                );
                $imp+=$servicio[$k]['imp'];
            }

            $result[count($result)] = array(
                'cliente' => '',
                'inicial' => '',
                'final' => '',
                'agencia' => '',
                'servicio' => '',
                'subservicio' => '',
                'cantsubserv' => '',
                'canthab' => '',
                'precio' => '',
                'noches' => '',
                'imp_aloj' => '',
                'imp_serv' => ' IMPORTE TOTAL: ' . Yii::$app->formatter->asDecimal($imp, 2),
            );
        }

//        if ($serv != '' && count($servicio) == 0) {
//            $result = array();
//        }
//
//        if ($incluir == 1 && count($servicio) == 0) {
//            $result = array();
//            print_r('SDS');
//            die;
//        }



        return $this->render('general', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'agencia' => $agencia,
                    'servicio' => $serv,
                    'subservicio' => $subserv,
                    'incluir' => $incluir,
                    'result' => $result,
        ]);
    }

    function actionGeneralExcel() {

        $entrada = Yii::$app->request->post('gen_entrada');
        $salida = Yii::$app->request->post('gen_salida');
        $agencia = Yii::$app->request->post('gen_agencia');
        $serv = Yii::$app->request->post('gen_serv');
        $subserv = Yii::$app->request->post('gen_sub');
        $incluir = Yii::$app->request->post('gen_incluir');



        $connection = \Yii::$app->db;
        $connection->open();
        $command = $connection->createCommand('SELECT reservacion.id,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,agencia.nombre as agencia, COUNT(habitacion.nombre) as canthab,habitacion.nombre as hab, sum(reservacion_hab.precio) as precio FROM reservacion,reservacion_hab,habitacion,agencia where reservacion_hab.fecha_entrada >=:entrada and reservacion_hab.fecha_entrada <=:salida and reservacion_hab.reservacion=reservacion.id  and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and reservacion_hab.precio>0  GROUP BY reservacion.nombre_cliente');
        $command->bindParam(':entrada', $entrada);
        $command->bindParam(':salida', $salida);
        $alojamiento = $command->queryAll();





        if ($agencia != 'Agencia') {
            $command = $connection->createCommand('SELECT reservacion.id,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,agencia.nombre as agencia, COUNT(habitacion.nombre) as canthab,habitacion.nombre as hab, sum(reservacion_hab.precio) as precio FROM reservacion,reservacion_hab,habitacion,agencia where reservacion_hab.fecha_entrada >=:entrada and reservacion_hab.fecha_entrada <=:salida and reservacion_hab.reservacion=reservacion.id  and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and agencia.id=:agencia and reservacion_hab.precio>0  GROUP BY reservacion.nombre_cliente');
            $command->bindParam(':entrada', $entrada);
            $command->bindParam(':salida', $salida);
            $command->bindParam(':agencia', $agencia);
            $alojamiento = $command->queryAll();
        }



        $result = array();


        $fecha = explode('-', $entrada);
        $entrada1 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];


        $fecha = explode('-', $salida);
        $salida1 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        for ($i = 0; $i < count($alojamiento); $i++) {
            $id = $alojamiento[$i]['id'];
            $imp = 0;


            $servicio = array();

            $command = $connection->createCommand('SELECT reservacion_servicios.id,servicio.nombre as serv,subservicios.nombre as subserv, COUNT(subservicios.nombre) as cantsubserv,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,SUM(reservacion_servicios.precio*reservacion_servicios.cant)as imp  FROM reservacion_servicios,servicio,subservicios WHERE reservacion_servicios.reservacion=:id and reservacion_servicios.estado=0 and reservacion_servicios.servicio=subservicios.id and subservicios.servicio=servicio.id  GROUP BY subservicios.nombre,reservacion_servicios.precio');
            $command->bindParam(':id', $id);
            $servicio = $command->queryAll();






            if ($serv != '' && $serv != 0) {
                $command = $connection->createCommand('SELECT
	reservacion_servicios.id,
	servicio.nombre AS serv,
	subservicios.nombre AS subserv,
	COUNT(subservicios.nombre) AS cantsubserv,
	SUM(reservacion_servicios.cant) AS cant,
	reservacion_servicios.precio,
	SUM(
		reservacion_servicios.precio * reservacion_servicios.cant
	) AS imp
FROM
	reservacion_servicios,
	servicio,
	subservicios
WHERE reservacion_servicios.reservacion=:id
AND reservacion_servicios.estado=0
AND reservacion_servicios.servicio=subservicios.id
AND subservicios.servicio=servicio.id
AND servicio.id=:sub
GROUP BY
	subservicios.nombre,
	reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $command->bindParam(':sub', $serv);
                $servicio = $command->queryAll();
            }


            if ($subserv != '' && $subserv != 0) {
                $command = $connection->createCommand('SELECT
	reservacion_servicios.id,
	servicio.nombre AS serv,
	subservicios.nombre AS subserv,
	COUNT(subservicios.nombre) AS cantsubserv,
	SUM(reservacion_servicios.cant) AS cant,
	reservacion_servicios.precio,
	SUM(
		reservacion_servicios.precio * reservacion_servicios.cant
	) AS imp
FROM
	reservacion_servicios,
	servicio,
	subservicios
WHERE reservacion_servicios.reservacion=:id
AND reservacion_servicios.estado=0
AND reservacion_servicios.servicio=subservicios.id
AND subservicios.id=:sub
AND subservicios.servicio=servicio.id
AND servicio.id=:ser
GROUP BY
	subservicios.nombre,
	reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $command->bindParam(':ser', $serv);
                $command->bindParam(':sub', $subserv);
                $servicio = $command->queryAll();
            }



//            if ($incluir == 1) {
//                $command = $connection->createCommand('SELECT reservacion_servicios.id,servicio.nombre as serv,subservicios.nombre as subserv, COUNT(subservicios.nombre) as cantsubserv,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,SUM(reservacion_servicios.precio*reservacion_servicios.cant)as imp  FROM reservacion_servicios,servicio,subservicios WHERE reservacion_servicios.reservacion=:id and reservacion_servicios.estado=1 and reservacion_servicios.servicio=subservicios.id and subservicios.servicio=servicio.id  GROUP BY subservicios.nombre,reservacion_servicios.precio');
//                $command->bindParam(':id', $id);
//                $servicio = $command->queryAll();
//            }

            if ($incluir == 1) {

                $command = $connection->createCommand('SELECT reservacion_servicios.id,servicio.nombre as serv,subservicios.nombre as subserv, COUNT(subservicios.nombre) as cantsubserv,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,SUM(reservacion_servicios.precio*reservacion_servicios.cant)as imp  FROM reservacion_servicios,servicio,subservicios WHERE reservacion_servicios.reservacion=:id and reservacion_servicios.estado=1 and reservacion_servicios.servicio=subservicios.id and subservicios.servicio=servicio.id  GROUP BY subservicios.nombre,reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $servicio = $command->queryAll();
            }

            if ($incluir == 1 && ($serv != '' && $serv != 0)) {



                $command = $connection->createCommand('SELECT
	reservacion_servicios.id,
	servicio.nombre AS serv,
	subservicios.nombre AS subserv,
	COUNT(subservicios.nombre) AS cantsubserv,
	SUM(reservacion_servicios.cant) AS cant,
	reservacion_servicios.precio,
	SUM(
		reservacion_servicios.precio * reservacion_servicios.cant
	) AS imp
FROM
	reservacion_servicios,
	servicio,
	subservicios
WHERE
	reservacion_servicios.reservacion =:id
AND reservacion_servicios.estado = 1
AND reservacion_servicios.servicio = subservicios.id
AND subservicios.servicio = servicio.id
AND servicio.id=:sub
GROUP BY
	subservicios.nombre,
	reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $command->bindParam(':sub', $serv);
                $servicio = $command->queryAll();
                // print_r($servicio);
            }

            if ($incluir == 1 && ($subserv != '' && $subserv != 0)) {
                $command = $connection->createCommand('SELECT reservacion_servicios.id,servicio.nombre as serv,subservicios.nombre as subserv, COUNT(subservicios.nombre) as cantsubserv,SUM(reservacion_servicios.cant) as cant,reservacion_servicios.precio,SUM(reservacion_servicios.precio*reservacion_servicios.cant)as imp  FROM reservacion_servicios,servicio,subservicios WHERE reservacion_servicios.reservacion=:id and reservacion_servicios.estado=1 and reservacion_servicios.servicio=:sub and reservacion_servicios.servicio=subservicios.id and subservicios.servicio=servicio.id  GROUP BY subservicios.nombre,reservacion_servicios.precio');
                $command->bindParam(':id', $id);
                $command->bindParam(':sub', $subserv);
                $servicio = $command->queryAll();
            }



            $start_ts = strtotime($alojamiento[$i]['fecha_entrada']);
            $end_ts = strtotime($alojamiento[$i]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $noches = round($diferencia / 86400);

            $imp = $noches * $alojamiento[$i]['precio'];

            $result[count($result)] = array(
                'cliente' => $alojamiento[$i]['nombre_cliente'],
                'inicial' => $entrada1,
                'final' => $salida1,
                'agencia' => $alojamiento[$i]['agencia'],
                'servicio' => '',
                'subservicio' => '',
                'cantsubserv' => '',
                'canthab' => $alojamiento[$i]['canthab'],
                'precio' => $alojamiento[$i]['precio'],
                'noches' => $noches,
                'imp_aloj' => $imp,
                'imp_serv' => '',
            );


            for ($k = 0; $k < count($servicio); $k++) {

                $result[count($result)] = array(
                    'cliente' => $alojamiento[$i]['nombre_cliente'],
                    'inicial' => $entrada1,
                    'final' => $salida1,
                    'agencia' => $alojamiento[$i]['agencia'],
                    'servicio' => $servicio[$k]['serv'],
                    'subservicio' => $servicio[$k]['subserv'],
                    'cantsubserv' => $servicio[$k]['cant'],
                    'canthab' => $alojamiento[$i]['canthab'],
                    'precio' => $servicio[$k]['precio'],
                    'noches' => '',
                    'imp_aloj' => '',
                    'imp_serv' => $servicio[$k]['imp'],
                );
                $imp+=$servicio[$k]['imp'];
            }

            $result[count($result)] = array(
                'cliente' => '',
                'inicial' => '',
                'final' => '',
                'agencia' => '',
                'servicio' => '',
                'subservicio' => '',
                'cantsubserv' => '',
                'canthab' => '',
                'precio' => '',
                'noches' => '',
                'imp_aloj' => '',
                'imp_serv' => ' IMPORTE TOTAL:' . $imp,
            );
        }

//        if ($serv != '' && count($servicio) == 0) {
//            $result = array();
//        }
//
//        if ($incluir == 1 && count($servicio) == 0) {
//            $result = array();
//            print_r('SDS');
//            die;
//        }



        return $this->render('general-excel', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'agencia' => $agencia,
                    'servicio' => $serv,
                    'subservicio' => $subserv,
                    'incluir' => $incluir,
                    'resultado' => $result,
        ]);
    }

    function actionPasadia() {
        $entrada = '';
        $salida = '';
        $agencia = '';
        $dia = array();
        return $this->render('pasadia', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'agen' => $agencia,
                    'dia' => $dia,
        ]);
    }

    public function actionInfopasadia() {
        $entrada = Yii::$app->request->post('ing_entrada');
        $salida = Yii::$app->request->post('ing_salida');
        $agencia = Yii::$app->request->post('pasadia_agencia');

        $fecha = explode('-', $entrada);
        $entrada1 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];


        $fecha = explode('-', $salida);
        $salida1 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand('select pasadia.id, pasadia.nombre, pasadia.fecha,agencia.nombre as agencia from pasadia,pasadia_servicio,agencia where pasadia.fecha BETWEEN :entrada and :salida and pasadia.agencia=agencia.id GROUP BY pasadia.id,pasadia.nombre ORDER BY pasadia.fecha');
        $command->bindParam(':entrada', $entrada1);
        $command->bindParam(':salida', $salida1);
        $pasadia = $command->queryAll();




        if ($agencia != '') {
            $command = $connection->createCommand('select pasadia.id, pasadia.nombre, pasadia.fecha,agencia.nombre as agencia from pasadia,pasadia_servicio,agencia where pasadia.fecha BETWEEN :entrada and :salida and pasadia.agencia=:agencia and agencia.id=pasadia.agencia GROUP BY pasadia.id,pasadia.nombre ORDER BY pasadia.fecha');
            $command->bindParam(':entrada', $entrada1);
            $command->bindParam(':salida', $salida1);
            $command->bindParam(':agencia', $agencia);
            $pasadia = $command->queryAll();
        }


        $dia = array();

        for ($i = 0; $i < count($pasadia); $i++) {

            $command = $connection->createCommand('SELECT SUM(pasadia_servicio.cant*pasadia_servicio.precio) as imp from pasadia_servicio where pasadia_servicio.pasadia=:id');
            $command->bindParam(':id', $pasadia[$i]['id']);
            $imp = $command->queryAll();

            $fe = explode('-', $pasadia[$i]['fecha']);

            $dia[count($dia)] = array(
                'nombre' => $pasadia[$i]['nombre'],
                'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                'agencia' => $pasadia[$i]['agencia'],
                'imp' => $imp[0]['imp'],
                'id' => $pasadia[$i]['id'],
            );
        }


        return $this->render('pasadia', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'agen' => $agencia,
                    'dia' => $dia,
        ]);
    }

    public function actionPasadiaExcel() {
        $entrada = Yii::$app->request->post('entrada');
        $salida = Yii::$app->request->post('salida');
        $agencia = Yii::$app->request->post('agencia');

        $fecha = explode('-', $entrada);
        $entrada1 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];


        $fecha = explode('-', $salida);
        $salida1 = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand('select pasadia.id, pasadia.nombre, pasadia.fecha,agencia.nombre as agencia from pasadia,pasadia_servicio,agencia where pasadia.fecha BETWEEN :entrada and :salida and pasadia.agencia=agencia.id GROUP BY pasadia.id,pasadia.nombre ORDER BY pasadia.fecha');
        $command->bindParam(':entrada', $entrada1);
        $command->bindParam(':salida', $salida1);
        $pasadia = $command->queryAll();




        if ($agencia != '') {
            $command = $connection->createCommand('select pasadia.id, pasadia.nombre, pasadia.fecha,agencia.nombre as agencia from pasadia,pasadia_servicio,agencia where pasadia.fecha BETWEEN :entrada and :salida and pasadia.agencia=:agencia and agencia.id=pasadia.agencia GROUP BY pasadia.id,pasadia.nombre ORDER BY pasadia.fecha');
            $command->bindParam(':entrada', $entrada1);
            $command->bindParam(':salida', $salida1);
            $command->bindParam(':agencia', $agencia);
            $pasadia = $command->queryAll();
        }


        $dia = array();

        for ($i = 0; $i < count($pasadia); $i++) {

            $command = $connection->createCommand('SELECT SUM(pasadia_servicio.cant*pasadia_servicio.precio) as imp from pasadia_servicio where pasadia_servicio.pasadia=:id');
            $command->bindParam(':id', $pasadia[$i]['id']);
            $imp = $command->queryAll();

            $fe = explode('-', $pasadia[$i]['fecha']);

            $dia[count($dia)] = array(
                'nombre' => $pasadia[$i]['nombre'],
                'fecha' => $fe[2] . '-' . $fe[1] . '-' . $fe[0],
                'agencia' => $pasadia[$i]['agencia'],
                'imp' => $imp[0]['imp'],
                'id' => $pasadia[$i]['id'],
            );
        }


        return $this->render('pasadia-excel', [
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'agen' => $agencia,
                    'dia' => $dia,
        ]);
    }

    public function actionTrabajadores() {
        $mes = '';
        $trab = '';
        $trabajador = array();
        return $this->render('trabajadores', [
                    'meses' => $mes,
                    'trab' => $trab,
                    'trabajador' => $trabajador,
        ]);
    }

    public function actionInfotrab() {
        $mes = Yii::$app->request->post('rep_inicial');
        $trab = Yii::$app->request->post('rep_agencia');

        $fe_en = explode('-', $mes);
        $rep_inicial = $fe_en[1] . '-' . $fe_en[0];
        $rep_inicial1 = '%' . $fe_en[1] . '-' . $fe_en[0] . '%';


        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand('SELECT trabajador.nombre,dpto.nombre as dpto,trabajador.id from trabajador,trab_funciones,dpto where trabajador.id=trab_funciones.trab and trab_funciones.fecha LIKE :fecha and trabajador.dpto=dpto.id and trab_funciones.estado=1 GROUP BY trabajador.nombre ORDER BY trabajador.nombre asc');
        $command->bindParam(':fecha', $rep_inicial1);
        $trabajadores = $command->queryAll();

        //$trabajadores = TrabFunciones::find()->where(['like', 'fecha', $rep_inicial])->groupBy(['trab'])->orderby("trab asc")->all();


        if ($trab != "") {
            //$trabajadores = TrabFunciones::find()->where(['like', 'fecha', $rep_inicial])->andWhere(['trab' => $trab])->groupBy(['trab'])->orderBy('trab asc')->all();
            $command = $connection->createCommand('SELECT trabajador.nombre,dpto.nombre as dpto,trabajador.id from trabajador,trab_funciones,dpto where trabajador.id=:trab and trabajador.id=trab_funciones.trab and trab_funciones.fecha LIKE :fecha and trabajador.dpto=dpto.id and trab_funciones.estado=1 GROUP BY trabajador.nombre ORDER BY trabajador.nombre asc');
            $command->bindParam(':fecha', $rep_inicial1);
            $command->bindParam(':trab', $trab);
            $trabajadores = $command->queryAll();
        }



        $trabaj = array();

        for ($i = 0; $i < count($trabajadores); $i++) {
            $cont = 0;
            $fun = TrabFunciones::find()->where(['like', 'fecha', $rep_inicial])->andWhere(['trab' => $trabajadores[$i]['id']])->andWhere(['estado' => 1])->all();
            for ($k = 0; $k < count($fun); $k++) {
                $cont+=$fun[$k]->cantidad * $fun[$k]->precio;
            }

            $trabaj[count($trabaj)] = array(
                'nombre' => $trabajadores[$i]['nombre'],
                'dpto' => $trabajadores[$i]['dpto'],
                'salario' => Yii::$app->formatter->asDecimal($cont, 2),
            );
        }


        return $this->render('trabajadores', [
                    'meses' => $mes,
                    'trab' => $trab,
                    'trabajador' => $trabaj,
        ]);
    }

    public function actionTrabExcel() {
        $mes = Yii::$app->request->post('mesexcel');
        $trab = Yii::$app->request->post('trabexcel');

        $fe_en = explode('-', $mes);
        $rep_inicial = $fe_en[1] . '-' . $fe_en[0];
        $rep_inicial1 = '%' . $fe_en[1] . '-' . $fe_en[0] . '%';


        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand('SELECT trabajador.nombre,dpto.nombre as dpto,trabajador.id from trabajador,trab_funciones,dpto where trabajador.id=trab_funciones.trab and trab_funciones.fecha LIKE :fecha and trabajador.dpto=dpto.id and trab_funciones.estado=1 GROUP BY trabajador.nombre ORDER BY trabajador.nombre asc');
        $command->bindParam(':fecha', $rep_inicial1);
        $trabajadores = $command->queryAll();

        //$trabajadores = TrabFunciones::find()->where(['like', 'fecha', $rep_inicial])->groupBy(['trab'])->orderby("trab asc")->all();


        if ($trab != "") {
            //$trabajadores = TrabFunciones::find()->where(['like', 'fecha', $rep_inicial])->andWhere(['trab' => $trab])->groupBy(['trab'])->orderBy('trab asc')->all();
            $command = $connection->createCommand('SELECT trabajador.nombre,dpto.nombre as dpto,trabajador.id from trabajador,trab_funciones,dpto where trabajador.id=:trab and trabajador.id=trab_funciones.trab and trab_funciones.fecha LIKE :fecha and trabajador.dpto=dpto.id and trab_funciones.estado=1 GROUP BY trabajador.nombre ORDER BY trabajador.nombre asc');
            $command->bindParam(':fecha', $rep_inicial1);
            $command->bindParam(':trab', $trab);
            $trabajadores = $command->queryAll();
        }



        $trabaj = array();

        for ($i = 0; $i < count($trabajadores); $i++) {
            $cont = 0;
            $fun = TrabFunciones::find()->where(['like', 'fecha', $rep_inicial])->andWhere(['trab' => $trabajadores[$i]['id']])->andWhere(['estado' => 1])->all();
            for ($k = 0; $k < count($fun); $k++) {
                $cont+=$fun[$k]->cantidad * $fun[$k]->precio;
            }

            $trabaj[count($trabaj)] = array(
                'nombre' => $trabajadores[$i]['nombre'],
                'dpto' => $trabajadores[$i]['dpto'],
                'salario' => Yii::$app->formatter->asDecimal($cont, 2),
            );
        }


        return $this->render('trabajadores-excel', [
                    'meses' => $mes,
                    'trab' => $trab,
                    'trabajador' => $trabaj,
        ]);
    }

}
