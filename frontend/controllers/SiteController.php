<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Gastos;
use frontend\models\Reservacion;
use frontend\models\Habitacion;
use frontend\models\Agencia;
use frontend\models\Subservicios;
use frontend\models\OcupacionHab;
use frontend\models\ReservacionServicios;
use frontend\models\ReservacionHab;
use frontend\models\Pasadia;
use frontend\models\Notificaciones;
use frontend\models\Addgastos;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSalvar() {
        return $this->render('salvar');
    }

    public function actionImportar() {
        return $this->render('imp');
    }

    public function actionRango() {
        $entrada = Yii::$app->request->get('entrada');
        $salida = Yii::$app->request->get('salida');

//        $fe_en = explode('-', $entrada);
//        $entrada = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];
//
//        $fe_en = explode('-', $salida);
//        $salida = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];



        $start_ts = strtotime($entrada);
        $end_ts = strtotime($salida);
        $diferencia = $end_ts - $start_ts;
        $dif_dias = round($diferencia / 86400) - 1;

        $fecha = array();
        $fecha[count($fecha)] = $entrada;

        for ($i = 0; $i < $dif_dias; $i++) {
            $mod_date1 = strtotime($entrada . "+ 1 days");
            $entrada = date("d-m-Y", $mod_date1);
            $fecha[count($fecha)] = $entrada;
        }
        echo json_encode($fecha);
    }

    public function actionNotify() {
        $id = Yii::$app->request->get('id');
// $notificacion = new Notificaciones();
        $notificacion = Notificaciones::findOne($id);



        $notificacion->estado = 1;

        if ($notificacion->save()) {
            $notificacionesActivas = Notificaciones::find()->where(['estado' => 0])->all();
            $response["status"] = 'Si';
            $response["cantidad"] = count($notificacionesActivas) > 0 ? count($notificacionesActivas) : 0;
        } else {
            $response["status"] = 'No';
            $response["cantidad"] = 0;
        }

        echo json_encode($response);
    }

    public function actionNotifychecked() {
        $notificaciones = Yii::$app->request->get('notificaciones');
// $notificacion = new Notificaciones();


        $notificacion = Notificaciones::find()->where(['estado' => 0])->all();

        for ($i = 0; $i < count($notificacion); $i++) {
            $notificacion[$i]->estado = 1;
            $notificacion[$i]->save();
        }

        $response["status"] = 'Si';
        $response["cantidad"] = 0;


        echo json_encode($response);
    }

    /* public function actionImportarbd() {

      $nombre = 'control_reservaciones' . date('Y-m-d-h-i-s') . '.sql';
      $directorio = 'C:\\php';
      $dir = $directorio . '\\' . $nombre;

      $user = 'root';
      $pass = '';
      $comand = 'C:\xampp\mysql\bin\mysqldump.exe --opt --user=' . $user . ' --password=' . $pass . ' control_reservaciones > ' . $dir;
      system($comand, $error);


      if (!is_dir($directorio)) {
      mkdir($direc, 0777, true);
      chmod($direc, 0777);
      }

      //        $handle = fopen($nombre . '.sql', 'w+');
      //        fwrite($handle,'');
      //        fclose($handle);

      $dowload = $nombre . '.sql';

      if (file_exists($dowload)) {
      header("Content-disposition: attachment;filename=$dowload");
      header("Content-Type: text/plain");
      readfile($dowload);
      }
      Yii::$app->session->setFlash('success', 'La Base de Datos se generó correctamente');
      return $this->redirect(['salvar']);

      /* $texto_inicial = "";
      $texto = "";
      $con_base = mysql_connect("localhost", "root", "");
      $base = "control_reservaciones";
      $tablas = mysql_query("show tables from $base;", $con_base);
      $texto_inicial.="create database if not exists $base;\n";
      $texto_inicial.="use $base;\n";
      while ($tabla = mysql_fetch_array($tablas)) {
      $mitabla = $tabla[0];
      $creates = mysql_query("show create table $base.$mitabla;", $con_base);
      while ($create = mysql_fetch_array($creates)) {
      $texto.=$create[1];
      $texto = ereg_replace("\n", " ", $texto);
      $datos = mysql_query("select * from $base.$mitabla;", $con_base);
      $campos = mysql_num_fields($datos);
      $regs = mysql_num_rows($datos);
      for ($i = 0; $i < $regs; $i++) {
      $inserta = "\ninsert into $mitabla(";
      for ($j = 0; $j < $campos; $j++) {
      $nombre = mysql_field_name($datos, $j);
      $inserta.="$nombre,";
      }
      $inserta = substr($inserta, 0, strlen($inserta) - 1) . ") values(";
      for ($j = 0; $j < $campos; $j++) {
      $tipo = mysql_field_type($datos, $j);
      $valor = mysql_result($datos, $i, $j);
      switch ($tipo) {
      case "string":
      case "date":
      case "time":
      $valor = "'$valor'";
      break;
      }
      $inserta.="$valor,";
      }
      $inserta = substr($inserta, 0, strlen($inserta) - 1) . ");";
      $texto.=$inserta;
      }
      }
      $texto = $texto_inicial . $texto;
      }
      $archivo = "control_reservaciones.sql";
      $texto = ereg_replace("CHARSET=latin1", "CHARSET=latin1;", $texto);
      header("Content-disposition: attachment;filename=$archivo");
      header("Content-Type: text/plain");
      echo $texto;
      } */

    public function actionSalvarbd() {
        $nombre = 'control_reservaciones' . date('Y-m-d') . '.sql';
        $directorio = 'D:\\andres\\BD';

        $dir = $directorio . '\\' . $nombre;

        $fecha = Yii::$app->request->post('fechaslava');
        $fe = explode('-', $fecha);
        $fecha = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

        $reservacion = Reservacion::find()->where(['<', 'fecha_entrada', $fecha])->all();
        $pasadia = Pasadia::find()->where(['<', 'fecha', $fecha])->all();
        $gastos = Addgastos::find()->where(['<', 'fecha', $fecha])->all();


        $user = 'root';
        $pass = '';

        $comand = 'D:\andres\xampp\mysql\bin\mysqldump.exe --opt --user=' . $user . ' --password=' . $pass . ' control_reservaciones > ' . $dir;
        system($comand, $error);


        if (!is_dir($directorio)) {
            mkdir($direc, 0777, true);
            chmod($direc, 0777);
        }

//        $handle = fopen($nombre . '.sql', 'w+');
//        fwrite($handle,'');
//        fclose($handle);

        $dowload = $nombre . '.sql';

        if (file_exists($dowload)) {
            header("Content-disposition: attachment;filename=$dowload");
            header("Content-Type: text/plain");
            readfile($dowload);
        }
        for ($i = 0; $i < count($reservacion); $i++) {
            $reservacion[$i]->delete();
        }

        for ($i = 0; $i < count($pasadia); $i++) {
            $pasadia[$i]->delete();
        }
        for ($i = 0; $i < count($gastos); $i++) {
            $gastos[$i]->delete();
        }
        Yii::$app->session->setFlash('success', 'La Base de Datos se generó correctamente');
        return $this->redirect(['salvar']);
    }

    public function actionCargarbd() {

        $direc = Yii::$app->request->post('archivo');
// print_r($direc);die;
        if ($direc == '') {
            Yii::$app->session->setFlash('error', 'Debe seleccionar una base de datos');
            return $this->redirect(['salvar']);
        }

        $directorio = 'D:\\andres\\BD';
        $dir = $directorio . '\\' . $direc;

        $user = 'root';
        $pass = '';
        $comand = 'D:\andres\xampp\mysql\bin\mysql.exe --user=' . $user . ' --password=' . $pass . ' control_reservaciones < ' . $dir;
        system($comand, $error);

        Yii::$app->session->setFlash('success', 'La Base de Datos se cargó correctamente');
        return $this->redirect(['salvar']);
    }

    /* public function actionExportarbd() {
      $conn = mysqli_connect("localhost", "root", "", "control_reservaciones");
      $mostrar = "show tables";
      $tablas = mysqli_query($conn, $mostrar);
      while ($tabla = mysqli_fetch_array($tablas)) {
      $todas[] = $tabla[0];
      }

      $result = "";
      for ($i = 0; $i < count($todas); $i++) {
      $result_column = "SELECT * FROM " . $todas[$i];
      $result_columnas = mysqli_query($conn, $result_column);
      $num_columnas = mysqli_num_fields($result_columnas);
      //echo 'cantidad d columnas '.$todas[$i].' - '.$num_columnas.'<br>';die;

      $result.="DROP TABLE IF EXITS " . $todas[$i] . ";";

      $result_cr_col = "SHOW CREATE TABLE " . $todas[$i];
      $resultado_cr_col = mysqli_query($conn, $result_cr_col);
      $row_cr_col = mysqli_fetch_row($resultado_cr_col);

      $result.="\n\n" . $row_cr_col[1] . ";\n\n";

      for ($k = 0; $k < $num_columnas; $k++) {
      while ($row_tp_col = mysqli_fetch_row($result_columnas)) {

      $result.="INSERT INTO " . $todas[$i] . " VALUES(";
      for ($j = 0; $j < $num_columnas; $j++) {
      $row_tp_col[$j] = addslashes($row_tp_col[$j]);
      $row_tp_col[$j] = str_replace("\n", "\\n", $row_tp_col[$j]);

      if (isset($row_tp_col[$j])) {
      $result.='"' . $row_tp_col[$j] . '"';
      } else {
      $result.='""';
      }

      if ($j < ($num_columnas - 1)) {
      $result.=',';
      }
      //print_r($result);
      }
      //die;
      $result.=');';
      }
      }
      $result.='\n\n';
      //            print_r($result);
      }
      //die;
      $direc = 'E:/backup/';

      if (!is_dir($direc)) {
      mkdir($direc, 0777, true);
      chmod($direc, 0777);
      }
      $fecha = date('Y-m-d-h-i-s');
      $nom_archivo = $direc . 'control_reservaciones_' . $fecha;

      $handle = fopen($nom_archivo . '.sql', 'w+');
      fwrite($handle, $result);
      fclose($handle);

      $dowload = $nom_archivo . '.sql';

      if (file_exists($dowload)) {
      header("Content-disposition: attachment;filename=$dowload");
      header("Content-Type: text/plain");
      readfile($dowload);
      return $this->redirect('index');
      }
      } */

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionExcel() {
        return $this->render('excel');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        $this->layout = "login_layout.php";

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionPrint() {
        $this->layout = "print_layout.php";

        $model = new LoginForm();
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    function actionCalendar() {
        $connection = \Yii::$app->db;
        $connection->open();
        $command = $connection->createCommand('select habitacion.nombre,reservacion.nombre_cliente,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,habitacion.codigo,reservacion.id FROM reservacion,habitacion,reservacion_hab where reservacion.id=reservacion_hab.reservacion and reservacion_hab.hab=habitacion.id');
        $pedidos = $command->queryAll();

        $mostrar = array();

        for ($i = 0; $i < count($pedidos); $i++) {
            $mostrar[$i] = array(
                'id' => $pedidos[$i]['id'],
                'title' => $pedidos[$i]['nombre'] . " " . $pedidos[$i]['nombre_cliente'],
                'start' => $pedidos[$i]['fecha_entrada'],
                'end' => $pedidos[$i]['fecha_salida'],
                'backgroundColor' => $pedidos[$i]['codigo'], //red
                'borderColor' => $pedidos[$i]['codigo'] //red
            );
        }

//var_dump($mostrar);die;
        echo json_encode($mostrar);
    }

    function actionPasadia() {
        $fe = date('Y') . '-' . date('m');
        $pasa = Pasadia::find()->where(['like', 'fecha', $fe])->all();
        $mostrar = array();
        for ($i = 0; $i < count($pasa); $i++) {
            $mostrar[$i] = array(
                'id' => $pasa[$i]->id,
                'title' => $pasa[$i]->nombre,
                'start' => $pasa[$i]->fecha,
                'backgroundColor' => '#0073b7', //red
                'borderColor' => '#ff851b' //red
            );
        }
//var_dump($mostrar);die;
        echo json_encode($mostrar);
    }

    function actionReshab() {
        $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('nombre ASC')->all();

        $res = array();

        for ($i = 0; $i < count($hab); $i++) {
            $res[$i] = array(
                'id' => $hab[$i]->id,
                'nombre' => $hab[$i]->nombre
            );
        }

        echo json_encode($res);
    }

    function actionCombo() {
        $res = Yii::$app->request->get('id');
        $hab = Yii::$app->request->get('hab');


        $connection = \Yii::$app->db;
        $connection->open();

        $result = array();
        $cont = 0;
        $imp = 0;



        $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and reservacion.conjunto=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
        $command2->bindParam(':reserva', $res);
        $command2->bindParam(':hab', $hab);
        $mos_res = $command2->queryAll();
        $connection->close();

        if ($hab == "") {
            $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and reservacion.conjunto=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
            $command2->bindParam(':reserva', $res);
            $mos_res = $command2->queryAll();
            $connection->close();
        }
// print_r($mos_res);die;



        if (count($mos_res) != 0) {

            $mos_hab = [];
            for ($i = 0; $i < count($mos_res); $i++) {
                if ($mos_res[$i]['nombre'] != 'ANEXO') {
                    $mos_hab[count($mos_hab)] = $mos_res[$i];
                }
            }

            $mos_res = $mos_hab;

            $result[count($result)] = array(
                'desc' => '<b style="font-size: 12px">ALOJAMIENTO</b>',
                'cant' => "",
                'precio' => '',
                'total' => ''
            );


            $start_ts = strtotime($mos_res[0]['fecha_entrada']);
            $end_ts = strtotime($mos_res[0]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);



            if ($hab == "") {
                for ($y = 0; $y < count($mos_res); $y++) {

                    $start_ts = strtotime($mos_res[$y]['fecha_entrada']);
                    $end_ts = strtotime($mos_res[$y]['fecha_salida']);
                    $diferencia = $end_ts - $start_ts;
                    $dif_dias = round($diferencia / 86400);

                    $result[count($result)] = array(
                        'desc' => '<p style="margin-left:1em">' . $mos_res[$y]['nombre'] . '</p>',
                        'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                        'precio' => '<p style="margin-left:1em">' . $mos_res[$y]['precio'] . '</p>',
                        'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($mos_res[$y]['precio'] * $dif_dias, 2) . '</p>'
                    );
                    $imp+=$mos_res[$y]['precio'] * $dif_dias;
                }
            } else {
                $result[count($result)] = array(
                    'desc' => '<p style="margin-left:1em">' . $mos_res[0]['nombre'] . '</p>',
                    'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                    'precio' => '<p style="margin-left:1em">' . $mos_res[0]['precio'] . '</p>',
                    'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($mos_res[0]['precio'] * $dif_dias, 2) . '</p>'
                );
                $imp+=$mos_res[0]['precio'] * $dif_dias;
            }
        }


        $command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.nombre ORDER BY servicio.prioridad asc');
        $command->bindParam(':reserva', $res);
        $command->bindParam(':hab', $hab);
        $servicios = $command->queryAll();

        if ($hab == "") {
            $command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.nombre ORDER BY servicio.prioridad asc');
            $command->bindParam(':reserva', $res);
            $servicios = $command->queryAll();
        }




        for ($i = 0; $i < count($servicios); $i++) {

            $command1 = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.nombre');
            $command1->bindParam(':reserva', $res);
            $command1->bindParam(':hab', $hab);
            $command1->bindParam(':serv', $servicios[$i]['id']);
            $subservicios = $command1->queryAll();

            if ($hab == "") {
                $command1 = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.nombre');
                $command1->bindParam(':reserva', $res);
                $command1->bindParam(':serv', $servicios[$i]['id']);
                $subservicios = $command1->queryAll();
            }


            $result[count($result)] = array(
                'desc' => "<b style='font-size: 12px';margin-left:-1em'>" . $servicios[$i]['nombre'] . "</b>",
                'cant' => ' ',
                'precio' => ' ',
                'total' => ' '
            );
            $cont++;

            for ($k = 0; $k < count($subservicios); $k++) {
                $result[count($result)] = array(
                    'desc' => '<p style="margin-left:1em">' . $subservicios[$k]['nombre'] . '</p>',
                    'cant' => '<p style="margin-left:2em">' . $subservicios[$k]['cant'] . '</p>',
                    'precio' => '<p style="margin-left:1em">' . $subservicios[$k]['precio'] . '</p>',
                    'total' => '<p style="margin-left:1em">' . $subservicios[$k]['total'] . '</p>'
                );
                $cont++;
                $imp+=$subservicios[$k]['total'];
            }
        }

        $result[count($result)] = array(
            'desc' => '',
            'cant' => '',
            'precio' => '<b style="margin-left:1em">' . 'TOTAL' . '</b>',
            'total' => '<b style="margin-left:1em">' . Yii::$app->formatter->asDecimal($imp, 2) . '</b>'
        );








        $columns = array(
            array('db' => 'desc', 'dt' => 0),
            array('db' => 'cant', 'dt' => 1),
            array('db' => 'precio', 'dt' => 2),
            array('db' => 'total', 'dt' => 3)
        );


        require( 'ssp.class.php' );


        $result2 = SSP::simple($result, $columns);


        echo json_encode($result2['data']);
    }

    /* IDIOMA DEL DATA TABLE */

    function actionIdioma() {
        $res = Yii::$app->request->get('id');
        $hab = Yii::$app->request->get('hab');
        $idioma = Yii::$app->request->get('idioma');

        $connection = \Yii::$app->db;
        $connection->open();

        $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
        $command2->bindParam(':reserva', $res);
        $mos_res = $command2->queryAll();

        if ($hab != "") {
            $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
            $command2->bindParam(':reserva', $res);
            $command2->bindParam(':hab', $hab);
            $mos_res = $command2->queryAll();
        }


        $result = array();
        $imp = 0;

        $mos_hab = [];
        for ($i = 0; $i < count($mos_res); $i++) {
            if ($mos_res[$i]['nombre'] != 'ANEXO') {
                $mos_hab[count($mos_hab)] = $mos_res[$i];
            }
        }
        $mos_res = $mos_hab;

        for ($i = 0; $i < count($mos_res); $i++) {

            if ($idioma == "Ingles") {
                $result[count($result)] = array(
                    'desc' => '<b style="font-size: 10px">LODGING</b>',
                    'cant' => "",
                    'precio' => '',
                    'total' => ''
                );
            } else {
                $result[count($result)] = array(
                    'desc' => '<b style="font-size: 10px">LOGEMENT</b>',
                    'cant' => "",
                    'precio' => '',
                    'total' => ''
                );
            }

            $start_ts = strtotime($mos_res[$i]['fecha_entrada']);
            $end_ts = strtotime($mos_res[$i]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);

            $imp+=$mos_res[$i]['precio'] * $dif_dias;
            $tota = 0;
            $total = Yii::$app->formatter->asDecimal($mos_res[$i]['precio'] * $dif_dias);

            if ($idioma == "Ingles") {
                $result[count($result)] = array(
                    'desc' => '<p style="margin-left:1em">' . $mos_res[$i]['nombre'] . '</p>',
                    'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                    'precio' => '<p style="margin-left:1em">' . $mos_res[$i]['precio'] . '</p>',
                    'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($total, 2) . '</p>'
                );
            } else {
                $result[count($result)] = array(
                    'desc' => '<p style="margin-left:1em">' . $mos_res[$i]['nombre'] . '</p>',
                    'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                    'precio' => '<p style="margin-left:1em">' . $mos_res[$i]['precio'] . '</p>',
                    'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($total, 2) . '</p>'
                );
            }
        }

        if ($idioma == "Ingles") {
            $command = $connection->createCommand('select servicio.id,servicio.ingles as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.ingles  ORDER BY servicio.prioridad asc');
        } else {
            $command = $connection->createCommand('select servicio.id,servicio.frances as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.frances  ORDER BY servicio.prioridad asc');
        }

        $command->bindParam(':reserva', $res);
        $servicios = $command->queryAll();



        if ($hab != "") {
            if ($idioma == "Ingles") {
                $command = $connection->createCommand('select servicio.id,servicio.ingles as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.ingles ORDER BY servicio.prioridad asc');
            } else {
                $command = $connection->createCommand('select servicio.id,servicio.frances as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.frances ORDER BY servicio.prioridad asc');
            }

            $command->bindParam(':reserva', $res);
            $command->bindParam(':hab', $hab);
            $servicios = $command->queryAll();
        }


        for ($i = 0; $i < count($servicios); $i++) {

            if ($idioma == "Ingles") {
                $command1 = $connection->createCommand('select subservicios.ingles as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.ingles');
            } else {
                $command1 = $connection->createCommand('select subservicios.frances as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.frances');
            }

            $command1->bindParam(':reserva', $res);
            $command1->bindParam(':serv', $servicios[$i]['id']);
            $subservicios = $command1->queryAll();

            if ($hab != "") {
                if ($idioma == "Ingles") {
                    $command1 = $connection->createCommand('select subservicios.ingles as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.ingles');
                } else {
                    $command1 = $connection->createCommand('select subservicios.frances as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado=0 GROUP BY reservacion_servicios.servicio ORDER BY subservicios.frances');
                }

                $command1->bindParam(':reserva', $res);
                $command1->bindParam(':hab', $hab);
                $command1->bindParam(':serv', $servicios[$i]['id']);
                $subservicios = $command1->queryAll();
            }



            $result[count($result)] = array(
                'desc' => "<b style='font-size: 10px';margin-left:-1em'>" . $servicios[$i]['nombre'] . "</b>",
                'cant' => ' ',
                'precio' => ' ',
                'total' => ' '
            );


            for ($k = 0; $k < count($subservicios); $k++) {
                $result[count($result)] = array(
                    'desc' => '<p style="margin-left:1em">' . $subservicios[$k]['nombre'] . '</p>',
                    'cant' => '<p style="margin-left:2em">' . $subservicios[$k]['cant'] . '</p>',
                    'precio' => '<p style="margin-left:1em">' . $subservicios[$k]['precio'] . '</p>',
                    'total' => '<p style="margin-left:1em">' . $subservicios[$k]['total'] . '</p>'
                );
                $imp+=$subservicios[$k]['total'];
            }
        }
        $imp = Yii::$app->formatter->asDecimal($imp);
        $imp.=' CUC';
        if ($idioma == "Ingles") {
            $result[count($result)] = array(
                'desc' => '',
                'cant' => '',
                'precio' => '<h4 style="margin-left:1em">' . ' TOTAL AMOUNT' . '</h4>',
                'total' => '<h4 style="margin-left:1em">' . Yii::$app->formatter->asDecimal($imp, 2) . '</h4>'
            );
        } else {

            $result[count($result)] = array(
                'desc' => '',
                'cant' => '',
                'precio' => '<h4 style="margin-left:1em">' . 'MONTANT TOTAL' . '</h4>',
                'total' => '<h4 style="margin-left:1em">' . Yii::$app->formatter->asDecimal($imp, 2) . '</h4>'
            );
        }


        $columns = array(
            array('db' => 'desc', 'dt' => 0),
            array('db' => 'cant', 'dt' => 1),
            array('db' => 'precio', 'dt' => 2),
            array('db' => 'total', 'dt' => 3)
        );


        require( 'ssp.class.php' );


        $result2 = SSP::simple($result, $columns);


        echo json_encode($result2['data']);
    }

    function actionCliente() {
        $id = Yii::$app->request->get('id');
        $fecha = Yii::$app->request->get('fecha');


        $fe_en = explode('-', $fecha);
        $fecha = $fe_en[1] . '-' . $fe_en[0];


        $cliente = Reservacion::find()->where(['like', 'fecha_entrada', $fecha])->andWhere(['agencia' => $id])->groupBy(['nombre_cliente'])->orderBy("nombre_cliente asc")->all();


        $resultado = array();
        for ($i = 0; $i < count($cliente); $i++) {
            $resultado[$i] = array(
                'id' => $cliente[$i]->id,
                'nombre' => $cliente[$i]->nombre_cliente
            );
        }

        echo json_encode($resultado);
    }

    function actionIdioma_pasa() {
        $id = Yii::$app->request->get('id_pasa');
        $idioma = Yii::$app->request->get('idioma');
        if ($idioma == "Ingles") {

            $imp = 0;
            $resultado = array();
            $connection = \Yii::$app->db;
            $connection->open();

            $command = $connection->createCommand('select servicio.id,servicio.ingles as nombre FROM servicio,subservicios,pasadia_servicio,pasadia where servicio.id=subservicios.servicio and subservicios.id=pasadia_servicio.servicio and  pasadia_servicio.pasadia=pasadia.id and pasadia.id=:pasa and pasadia_servicio.incluir=0 GROUP BY servicio.nombre ORDER BY servicio.prioridad');
            $command->bindParam(':pasa', $id);
            $result = $command->queryAll();

            for ($i = 0; $i < count($result); $i++) {
                $command1 = $connection->createCommand('select subservicios.ingles as nombre, SUM(pasadia_servicio.cant)as cant,pasadia_servicio.precio,SUM(pasadia_servicio.cant)*pasadia_servicio.precio as total  from subservicios,pasadia_servicio,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=pasadia_servicio.servicio and pasadia_servicio.pasadia=:pasa and pasadia_servicio.incluir=0 GROUP BY pasadia_servicio.servicio ORDER BY subservicios.nombre ');
                $command1->bindParam(':serv', $result[$i]['id']);
                $command1->bindParam(':pasa', $id);
                $subservicios = $command1->queryAll();

                $resultado[count($resultado)] = array(
                    'desc' => '<h6>' . $result[$i]['nombre'] . '</h6>',
                    'cant' => ' ',
                    'precio' => ' ',
                    'total' => ' '
                );

                for ($k = 0; $k < count($subservicios); $k++) {
                    $resultado[count($resultado)] = array(
                        'desc' => $subservicios[$k]['nombre'],
                        'cant' => $subservicios[$k]['cant'],
                        'precio' => $subservicios[$k]['precio'],
                        'total' => $subservicios[$k]['total']
                    );

                    $imp+=$subservicios[$k]['total'];
                }
            }

            $resultado[count($resultado)] = array(
                'desc' => '',
                'cant' => '',
                'precio' => '<h6>TOTAL AMOUNT</h6>',
                'total' => '<h6>' . Yii::$app->formatter->asDecimal($imp, 2) . ' CUC </h6>'
            );
        } else {
            $imp = 0;
            $resultado = array();
            $connection = \Yii::$app->db;
            $connection->open();

            $command = $connection->createCommand('select servicio.id,servicio.frances as nombre FROM servicio,subservicios,pasadia_servicio,pasadia where servicio.id=subservicios.servicio and subservicios.id=pasadia_servicio.servicio and  pasadia_servicio.pasadia=pasadia.id and pasadia.id=:pasa and pasadia_servicio.incluir=0 GROUP BY servicio.nombre ORDER BY servicio.prioridad');
            $command->bindParam(':pasa', $id);
            $result = $command->queryAll();

            for ($i = 0; $i < count($result); $i++) {
                $command1 = $connection->createCommand('select subservicios.frances as nombre, SUM(pasadia_servicio.cant)as cant,pasadia_servicio.precio,SUM(pasadia_servicio.cant)*pasadia_servicio.precio as total  from subservicios,pasadia_servicio,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=pasadia_servicio.servicio and pasadia_servicio.pasadia=:pasa and pasadia_servicio.incluir=0 GROUP BY pasadia_servicio.servicio ORDER BY subservicios.nombre ');
                $command1->bindParam(':serv', $result[$i]['id']);
                $command1->bindParam(':pasa', $id);
                $subservicios = $command1->queryAll();

                $resultado[count($resultado)] = array(
                    'desc' => '<h6>' . $result[$i]['nombre'] . '</h6>',
                    'cant' => ' ',
                    'precio' => ' ',
                    'total' => ' '
                );

                for ($k = 0; $k < count($subservicios); $k++) {
                    $resultado[count($resultado)] = array(
                        'desc' => $subservicios[$k]['nombre'],
                        'cant' => $subservicios[$k]['cant'],
                        'precio' => $subservicios[$k]['precio'],
                        'total' => $subservicios[$k]['total']
                    );

                    $imp+=$subservicios[$k]['total'];
                }
            }

            $resultado[count($resultado)] = array(
                'desc' => '',
                'cant' => '',
                'precio' => '<h6>MONTANT TOTAL</h6>',
                'total' => '<h6>' . Yii::$app->formatter->asDecimal($imp, 2) . ' CUC </h6>'
            );
        }

        $columns = array(
            array('db' => 'desc', 'dt' => 0),
            array('db' => 'cant', 'dt' => 1),
            array('db' => 'precio', 'dt' => 2),
            array('db' => 'total', 'dt' => 3)
        );


        require( 'ssp.class.php' );


        $result2 = SSP::simple($resultado, $columns);


        echo json_encode($result2['data']);
    }

    /* function actionCombo() {


      $res = Yii::$app->request->get('id');
      $hab = Yii::$app->request->get('hab');

      $servicios = null;

      if ($hab == "") {
      $connection = \Yii::$app->db;
      $connection->open();
      $command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva GROUP BY servicio.nombre');
      $command->bindParam(':reserva', $res);
      $servicios = $command->queryAll();
      } else {
      $connection = \Yii::$app->db;
      $connection->open();
      $command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva GROUP BY servicio.nombre');
      $command->bindParam(':reserva', $res);
      $command->bindParam(':hab', $hab);
      $servicios = $command->queryAll();
      }



      $result = array();
      $cont = 0;
      $imp = 0;
      for ($i = 0; $i < count($servicios); $i++) {
      $subservicios = null;
      if ($hab == "") {
      $command1 = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva GROUP BY reservacion_servicios.servicio ORDER BY subservicios.nombre');
      $command1->bindParam(':reserva', $res);
      $command1->bindParam(':serv', $servicios[$i]['id']);
      $subservicios = $command1->queryAll();
      } else {
      $command1 = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab GROUP BY reservacion_servicios.servicio ORDER BY subservicios.nombre');
      $command1->bindParam(':reserva', $res);
      $command1->bindParam(':hab', $hab);
      $command1->bindParam(':serv', $servicios[$i]['id']);
      $subservicios = $command1->queryAll();
      }

      $result[$cont] = array(
      'desc' => $servicios[$i]['nombre'],
      'cant' => ' ',
      'precio' => ' ',
      'total' => ' '
      );
      $cont++;

      for ($k = 0; $k < count($subservicios); $k++) {
      $result[$cont] = array(
      'desc' => $subservicios[$k]['nombre'],
      'cant' => $subservicios[$k]['cant'],
      'precio' => $subservicios[$k]['precio'],
      'total' => $subservicios[$k]['total']
      );
      $cont++;
      $imp+=$subservicios[$k]['total'];
      }
      }
      //print_r($result);die;

      $cont = count($result);

      if ($hab == "") {
      $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion.fecha_entrada,reservacion.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY reservacion.fecha_entrada,reservacion.fecha_salida');
      $command2->bindParam(':reserva', $res);
      $mos_res = $command2->queryAll();
      $connection->close();
      } else {
      $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion.fecha_entrada,reservacion.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY reservacion.fecha_entrada,reservacion.fecha_salida');
      $command2->bindParam(':reserva', $res);
      $command2->bindParam(':hab', $hab);
      $mos_res = $command2->queryAll();
      $connection->close();
      }

      print_r($mos_res);die;


      if (count($mos_res) != 0) {

      $start_ts = strtotime($mos_res[0]['fecha_entrada']);
      $end_ts = strtotime($mos_res[0]['fecha_salida']);
      $diferencia = $end_ts - $start_ts;
      $dif_dias = round($diferencia / 86400);

      $result[$cont] = array(
      'desc' => 'ALOJAMIENTO',
      'cant' => "",
      'precio' => '',
      'total' => ''
      );
      $cont++;
      if ($hab == "") {
      for ($y = 0; $y < count($mos_res); $y++) {
      $result[$cont] = array(
      'desc' => $mos_res[$y]['nombre'],
      'cant' => "(" . $dif_dias . ") Noches",
      'precio' => $mos_res[$y]['precio'],
      'total' => $mos_res[$y]['precio'] * $dif_dias
      );
      $cont++;
      $imp+=$mos_res[$y]['precio'] * $dif_dias;
      }
      } else {
      $result[$cont + 1] = array(
      'desc' => $mos_res[0]['nombre'],
      'cant' => "(" . $dif_dias . ") Noches",
      'precio' => $mos_res[0]['precio'],
      'total' => $mos_res[0]['precio'] * $dif_dias
      );

      $imp+=$mos_res[0]['precio'] * $dif_dias;
      }




      $result[count($result)] = array(
      'desc' => '',
      'cant' => '',
      'precio' => 'Importe',
      'total' => $imp
      );
      } else {

      $result[count($result)] = array(
      'desc' => '',
      'cant' => '',
      'precio' => 'Importe',
      'total' => $imp
      );
      }


      $columns = array(
      array('db' => 'desc', 'dt' => 0),
      array('db' => 'cant', 'dt' => 1),
      array('db' => 'precio', 'dt' => 2),
      array('db' => 'total', 'dt' => 3)
      );


      require( 'ssp.class.php' );


      $result2 = SSP::simple($result, $columns);


      echo json_encode($result2['data']);
      } */

    public function actionFecha() {
        $fecha_ent = Yii::$app->request->get('fe_entrada');
        $fecha_sal = Yii::$app->request->get('fe_salida');




        $fe_en = explode('-', $fecha_ent);
        $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

        $fe_sa = explode('-', $fecha_sal);
        $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

        $hab = Habitacion::find()->where(['codigo' => 0])->orderBy('id ASC')->all();

        $data = array();
        $ha = array();
        $cont = 0;

        for ($i = 0; $i < count($hab); $i++) {

            $id_hab = $hab[$i]->id;

            $connection = \Yii::$app->db;
            $connection->open();

            $command = $connection->createCommand('SELECT reservacion.nombre_cliente FROM reservacion,reservacion_hab WHERE  (reservacion_hab.hab = :habitacion) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion.fecha_entrada <= :entrada1) AND (reservacion.fecha_salida > :salida1) AND (reservacion_hab.estado=0)  OR (reservacion.fecha_entrada <=:entrada2 ) AND (reservacion.fecha_salida >= :salida2) AND (reservacion.fecha_entrada > :entrada3 AND reservacion.fecha_entrada < :salida3) AND  (reservacion_hab.hab = :habitacion1)AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0) OR (reservacion.fecha_salida > :entrada4 AND reservacion.fecha_salida < :salida4) AND (reservacion_hab.hab = :habitacion2) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0)');
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

            $ha[$i] = array(
                'id' => $hab[$i]->id,
                'nombre' => $hab[$i]->nombre
            );

            if (count($result) == 0) {
// if ($hab[$i]->nombre != 'ANEXO') {
                $data[$cont] = array(
                    'id' => $hab[$i]->id,
                    'nombre' => $hab[$i]->nombre
                );
                $cont++;
//}
            }
        }

//print_r($data);die;
//print_r($data);die;
        echo json_encode(array('dis' => $data, 'hab' => $ha));
    }

    public function actionUsuarios() {

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'El usuario se ha creado satisfactoriamente');


            /* $fecha = date('Y-m-d');
              $trazas = new Trazas();
              $trazas->accion = 'Adicionar';
              $trazas->observaciones = 'Se ha creado un usuario con el nombre de : ' . $model->nombre . ' ' . $model->apellidos;
              $trazas->usuario = Yii::$app->user->identity->username;
              $trazas->fecha = $fecha;
              $trazas->save(); */


            return $this->redirect(['user/index']);
        } else {
            return $this->render('usuarios', [
                        'model' => $model,
            ]);
        }
    }

//    public function actionGastos() {
//
//        $nombre = Yii::$app->request->get('nombre');
//        $precio = Yii::$app->request->get('precio');
//        $fecha = Yii::$app->request->get('fecha');
//
//        $model = new Gastos();
//        $model->nombre = $nombre;
//        $model->precio = $precio;
//        $model->fecha = $fecha;
//
//        $response = array(
//            "estatus" => "",
//            "msg" => "Gastos"
//        );
//
//        if ($model->save()) {
//            $response[
//                    "status"] = 'Si';
//        } else {
//            $response["status"] = 'No';
//        }
//
//        echo json_encode($response);
//    }

    function actionHab() {
        $id = Yii::$app->request->get('id');



        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand('select ocupacion_hab.id,ocupacion.nombre from ocupacion,ocupacion_hab where ocupacion.id=ocupacion_hab.ocupacion and ocupacion_hab.hab=:habitacion');
        $command->bindParam(':habitacion', $id);
        $result = $command->queryAll();

        if (count($result) != 0) {
            $response["status"] = 'Si';
            $response["array"] = $result;
        } else {

            $response["status"] = 'No';
            $response["array"] = array();
        }

        echo json_encode($response);
    }

    function actionOcup() {
        $id = Yii::$app->request->get('id');
        $precio = OcupacionHab::find()->where(['id' => $id])->all();

        $response["status"] = 'Si';
        $response["precio"] = $precio[0]->precio;


        echo json_encode($response);
    }

    public function actionReservacion() {
        $model = new Reservacion();
        if ($model->load(Yii::$app->request->post())) {
            $model->estado = 0;
            $hab = $model->hab;


//            FUNCION PARA SACAR DIFERENCIAS DE DIAS DE DOS FECHAS
//            $start_ts = strtotime($model->fecha_entrada);
//            $end_ts = strtotime($model->fecha_salida);
//            $diferencia = $end_ts - $start_ts;
//            $dif_dias = round($diferencia / 86400);


            $fecha_ent = $model->fecha_entrada;
            $fecha_sal = $model->fecha_salida;

            if ($fecha_ent >= $fecha_sal) {
                return $this->redirect(['index', 'men_res' => 2]);
            }

            $connection = \Yii::$app->db;
            $connection->open();

            $command = $connection->createCommand('SELECT * FROM reservacion WHERE  (hab = :habitacion) AND (fecha_entrada <= :entrada1) AND (fecha_salida > :salida1) OR (fecha_entrada <= :entrada2) AND (fecha_salida >= :salida2) AND (fecha_entrada > :entrada3 AND fecha_entrada < :salida3) AND  (hab = :habitacion1) OR (fecha_salida > :entrada4 AND fecha_salida < :salida4) AND (hab = :habitacion2)');
            $command->bindParam(':habitacion', $hab);
            $command->bindParam(':entrada1', $fecha_ent);
            $command->bindParam(':salida1', $fecha_ent);
            $command->bindParam(':entrada2', $fecha_sal);
            $command->bindParam(':salida2', $fecha_sal);
            $command->bindParam(':entrada3', $fecha_ent);
            $command->bindParam(':salida3', $fecha_sal);
            $command->bindParam(':habitacion1', $hab);
            $command->bindParam(':entrada4', $fecha_ent);
            $command->bindParam(':salida4', $fecha_sal);
            $command->bindParam(':habitacion2', $hab);
            $result = $command->queryAll();

            echo "<script type='text/javascript'> alert('hola')</script>";


            if (count($result) == 0) {
                $model->save();
                return $this->redirect(['index', 'men_res'
                            => 1]);
            } else {
                return $this->redirect(['index', 'men_res' => 0]);
            }
        }
    }

//    public function actionAgencia() {
//        $nombre = Yii::$app->request->get('nombre');
//        $pago = Yii::$app->request->get('pago');
//        $model = new Agencia();
//        $model->nombre = $nombre;
//        $model->pago = $pago;
//
//
//        $response = array(
//            "estatus" => "",
//            "msg" => "Agencia"
//        );
//
//        if ($model->save()) {
//            $response[
//                    "status"] = 'Si';
//        } else {
//            $response["status"] = 'No';
//        }
//
//        echo json_encode($response);
//    }
//    public function actionSubservicio() {
//        $sub = Yii::$app->request->get('sub');
//        $nombre = Yii::$app->request->get('nombre');
//        $precio = Yii::$app->request->get('precio');
//
//        $model = new Subservicios();
//
//        $model->servicio = $sub;
//        $model->nombre = $nombre;
//        $model->precio = $precio;
//
//        $response = array(
//            "estatus" => "",
//            "msg" => "Agencia"
//        );
//
//        if ($model->save()) {
//            $response[
//                    "status"] = 'Si';
//        } else {
//            $response["status"] = 'No';
//        }
//
//        echo json_encode(
//                $response);
//    }



    public function actionSub() {
        $$id = Yii::$app->request->get('id');
        $sub = Subservicios::find()->where(['servicio' => $id])->orderby('nombre asc')->all();
        $response = array();
        for ($i = 0; $i < count($sub); $i++) {
            $response[$i] = array(
                'id' => $sub[$i]->id,
                'nombre' => $sub[$i]->nombre
            );
        }
        echo json_encode($response);
    }
    

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function

    actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
