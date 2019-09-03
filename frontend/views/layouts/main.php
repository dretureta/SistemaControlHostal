<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Reservacion;
use frontend\models\Addgastos;
use frontend\models\ReservacionServicios;
use frontend\models\Pasadia;
use frontend\models\PasadiaServicio;
use frontend\models\Notificaciones;

$asset = AppAsset::register($this);

$logged = 0;
$fechaActual = date('Y-m-d');

//parent::find()->where(['<>', 'id', 1]);

$reservas = Reservacion::find()->where(['>=', 'fecha_entrada', $fechaActual])->all();

$activas = count(Reservacion::find()->where(['estado' => 1])->all());
$resactivas = Reservacion::find()->where(['estado' => 1])->all();

$no = date('Y-m-d');



//No se que hace esto de momento nada
for ($i = 0; $i < count($resactivas); $i++) {
    if ($resactivas[$i]->fecha_salida == $no) {
        $not = new Notificaciones();
    }
}



//Chequear Reservas y en dependencia de las fecha de entrada y salida muestro una notificacion
//for ($i = 0; $i < count($reservas); $i++) {
//
//    $start_fe = strtotime($fechaActual);
//    $end_fe = strtotime($reservas[$i]->fecha_entrada);
//    $diferencia_fe = $end_fe - $start_fe;
//    $dif_dias_fe = round($diferencia_fe / 86400);
//
//
//    $start_fs = strtotime($fechaActual);
//    $end_fs = strtotime($reservas[$i]->fecha_salida);
//    $diferencia_fs = $end_fs - $start_fs;
//    $dif_dias_fs = round($diferencia_fs / 86400);
//
//
//   if($dif_dias_fe < 4){
//        $notificacion = new Notificaciones();
//        $notificacion->tipo = 'entrada';
//        $notificacion->titulo = 'Reserva Pendiente a entrada';
//        $notificacion->notificacion = 'La reserva del Cliente: ' . $reservas[$i]->nombre_cliente . ' con fecha del ' . $reservas[$i]->fecha_entrada . ' al ' . $reservas[$i]->fecha_salida . ' esta proxima a activarse';
//        $notificacion->fecha = md5('Ref'.$reservas[$i]->nombre_cliente . ''. $reservas[$i]->fecha_entrada. '' .$reservas[$i]->fecha_salida);
//
//        if(count(Notificaciones::find()->where(['fecha' => md5('Ref'.$reservas[$i]->nombre_cliente . ''. $reservas[$i]->fecha_entrada. '' .$reservas[$i]->fecha_salida)])->all()) == 0){
//            $notificacion->save();
//        }
//
//   }elseif($dif_dias_fs == 1){
//        $notificacion = new Notificaciones();
//        $notificacion->tipo = 'salida';
//        $notificacion->titulo = 'Reserva Pendiente a salida';
//        $notificacion->notificacion = 'La reserva del Cliente: ' . $reservas[$i]->nombre_cliente . ' con fecha del ' . $reservas[$i]->fecha_entrada . ' al ' . $reservas[$i]->fecha_salida . ' esta proxima a terminarse';
//        $notificacion->fecha = md5('Ref'.$reservas[$i]->nombre_cliente . ''. $reservas[$i]->fecha_entrada. '' .$reservas[$i]->fecha_salida);
//
//        if(count(Notificaciones::find()->where(['fecha' => md5('Ref'.$reservas[$i]->nombre_cliente . ''. $reservas[$i]->fecha_entrada. '' .$reservas[$i]->fecha_salida)])->all()) == 0){
//            $notificacion->save();
//        }
//   }
//}


$notificacionesActivas = Notificaciones::find()->where(['estado' => 0])->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script>
            //var base_url_gastos = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/gastos'); ?>';
            //var base_url_agencia = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/agencia'); ?>';
            //var base_url_sub = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/subservicio'); ?>';
            var base_url_hab = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/hab'); ?>';
            var base_url_ocup = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/ocup'); ?>';
            var base_url_combo = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/combo'); ?>';
            var base_url_fecha = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/fecha'); ?>';
            var base_url_reshab = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/reshab'); ?>';
            var base_url_idioma = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/idioma'); ?>';
            var base_url_notify = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/notify'); ?>';
            var base_url_notifychecked = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/notifychecked'); ?>';
            var base_url_cliente = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/cliente'); ?>';
            var base_url_sub = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('dependencias/sub'); ?>';
            var base_url_aloj = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('agencia/alojamiento'); ?>';
            var base_url_rango = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/rango'); ?>';
            var base_url_precio = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('trabajador/precio'); ?>';
            var base_url_subprueba = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('dependencias/subservicios'); ?>';



        </script>



    </head>




    <?php $this->beginBody() ?> 
    <body class="theme-indigo" ng-app="SistemaReservas">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-indigo">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Cargando...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->

        <!-- Top Bar -->
        <nav class="navbar" style="height: 6em">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="<?= Yii::$app->urlManager->createAbsoluteUrl('site/index'); ?>"><b style="font-size: 32px">Control de Reservas</b></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">

                        <!--                       <li class="">
                                                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('site/excel') ?>"  role="button">
                                                        <i class="material-icons" data-toggle="tooltip" data-placement="top" title="Exportar Excel">grid_on</i>
                                                    </a>
                                                </li>-->

                        <!--                        <li class="">
                                                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('site/importarbd') ?>"  role="button">
                                                        <i class="material-icons" data-toggle="tooltip" data-placement="top" title="">archive</i>
                                                    </a>
                                                </li>-->

                        <!-- Notifications -->
                        <!--                        <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" data-placement="top" title="Notificaciones">
                                                        <i class="material-icons">notifications</i>
                                                        <span id="notifycount" class="label-count"><?= count($notificacionesActivas) ?></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="header">NOTIFICACIONES</li>
                                                        <li class="body">
                                                            <ul class="menu">
                        
                        <?php for ($i = 0; $i < count($notificacionesActivas); $i++) { ?>
                                                    
                                                                                                <li id="<?= $notificacionesActivas[$i]->id ?>">
                                                                                                    <a data-notify data-notifyid="<?= $notificacionesActivas[$i]->id ?>" >
                                                                                                        <div class="row">
                                                    
                                                                                                            <div class="col-md-12">
                                                    
                                                                                                                <div class="menu-info">
                                                                                                                    <h4>
                                                                                                                        <div class="icon-circle bg-<?php
                            if ($notificacionesActivas[$i]->tipo == 'entrada') {
                                echo 'green';
                            } else {
                                echo 'red';
                            }
                            ?>">
                                                                                                                            <i class="material-icons">hotel</i>
                                                                                                                        </div>
                            <?= $notificacionesActivas[$i]->titulo ?></h4>
                                                                                                                    <p style="color:black">
                                                                                                                        <i style="color:black" class="material-icons">date_range</i> <?= $notificacionesActivas[$i]->notificacion ?>
                                                                                                                    </p>
                                                                                                                </div>
                                                    
                                                                                                            </div>
                                                                                                        </div>
                                                    
                                                    
                                                                                                    </a>
                                                                                                </li>
                        <?php } ?>
                        
                                                            </ul>
                                                        </li>
                                                        <li class="footer">
                                                            <a data-notifychecked href="">Marcar todas como leidas</a>
                                                        </li>
                                                    </ul>
                                                </li>-->
                        <!-- #END# Notifications -->
                    </ul>



                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section style="margin-top: -0.2em">
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar" style="width: 250px;margin-top: -0.9em">
                <!-- User Info -->
                <div class="user-info" style="margin-top: 0.5em">

                    <?php if (Yii::$app->user->isGuest) { ?>
                        <a class="" href="<?= Yii::$app->urlManager->createAbsoluteUrl('site/login') ?>"><i class="fa fa-sign-in"></i> Administracion</a>

                        <?php
                    } else {
                        $logged = 1
                        ?>
                        <div class="image">
                            <img src="<?= $asset->baseUrl . '/images/user.png' ?>" width="48" height="48" alt="User" />
                        </div>

                        <div class="info-container">
                            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= Yii::$app->user->identity->username ?></div>
                            <div class="email"><?= Yii::$app->user->identity->email ?></div>
                            <div class="btn-group user-helper-dropdown">
                                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>

                                    <li role="seperator" class="divider"></li>
                                    <li><a data-method="post" href="<?= Yii::$app->urlManager->createAbsoluteUrl('site/logout'); ?>"><i class="material-icons">input</i><?= 'Salir (' . Yii::$app->user->identity->username . ')' ?></a></li>
                                </ul>
                            </div>
                        </div>

                    <?php }
                    ?>

                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                        <li class="header">Menu Principal</li>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('site/index'); ?>">
                                <i class="material-icons">home</i>
                                <span>Calendario</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('reservacion/index'); ?>">
                                <i class="material-icons">hotel</i>
                                <span>Reservaciones</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('pasadia/index'); ?>">
                                <i class="material-icons">directions_walk</i>
                                <span>Pasadia</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('gastos/index'); ?>">
                                <i class="material-icons">monetization_on</i>
                                <span>Gastos</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('trabajador/index'); ?>">
                                <i class="material-icons">contacts</i>
                                <span>Trabajador</span>
                            </a>
                        </li>


                        <?php if ($logged == 1) { ?>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">settings</i>
                                    <span>Auxiliares</span>
                                </a>
                                <ul class="ml-menu">

                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('servicio/index'); ?>">Servicios</a>
                                    </li>

                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('agencia/index'); ?>">Agencia</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('habitacion/index'); ?>">Habitacion</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('ocupacion/index'); ?>">Ocupacion</a>
                                    </li>

                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('unidad/index'); ?>">Unidad</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('plan/index'); ?>">Plan</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('funciones/index'); ?>">Funciones</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('dpto/index'); ?>">Departamento</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">poll</i>
                                    <span>Reportes</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('reportes/agencia'); ?>">Agencias</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('reportes/gastos'); ?>">Gastos</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('reportes/ingresos'); ?>">Ingresos</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('reportes/general'); ?>">General</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('reportes/pasadia'); ?>">Pasadia</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('reportes/trabajadores'); ?>">Trabajadores</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">poll</i>
                                    <span>Administración</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('user/index'); ?>">Usuario</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('site/salvar'); ?>"> Base de Datos</a>
                                    </li>


                                </ul>
                            </li>


                        <?php } ?>


                    </ul>
                </div>
                <!-- #Menu -->




                <!-- Footer -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2017 <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('site/index'); ?>">Control de Reservas</a>.
                    </div>
                    <div class="version">
                        <b>Version: </b> 1.0
                    </div>
                </div>
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->


        </section>


        <?php
        $fecha = date('Y') . "-" . date('m');

        $sum_gastos = Addgastos::find()->where(['like', 'fecha', $fecha])->all();
        $sum_ga = 0;
        for ($i = 0; $i < count($sum_gastos); $i++) {
            $sum_ga+=$sum_gastos[$i]->importe;
        }


        /* $sum_reservacion = Reservacion::find()
          ->innerJoin('reservacion_hab', $on = 'reservacion.id=reservacion_hab.reservacion')
          ->where(['like', 'fecha_entrada', $fecha])
          ->all();
          print_r($sum_reservacion);die; */


        $sum_pasadia = 0;
        $pasadia = Pasadia::find()->where(['like', 'fecha', $fecha])->andWhere(['estado' => 0])->all();
        for ($i = 0; $i < count($pasadia); $i++) {
            $ser = PasadiaServicio::find()->andWhere(['pasadia' => $pasadia[$i]->id])->andWhere(['incluir' => 0])->all();
            for ($k = 0; $k < count($ser); $k++) {
                $sum_pasadia+=$ser[$k]->cant * $ser[$k]->precio;
            }
        }



        $fecha_entrada = date('Y') . "-" . date('m') . "-" . "01";
        $fecha_salida = date('Y') . "-" . date('m') . "-" . "31";
        $connection = \Yii::$app->db;
        $connection->open();
        /*  ESTA CONSULTA LE FALTA EL LIKE PARA Q SEA DEL MES EN CURSO                                      
          and reservacion.fecha_entrada like %:$fecha% */
        $command = $connection->createCommand("SELECT reservacion.fecha_entrada,reservacion.fecha_salida,reservacion_hab.precio from reservacion,reservacion_hab where reservacion.id=reservacion_hab.reservacion   and reservacion.fecha_entrada >=:fecha_ent and reservacion.fecha_entrada <=:fecha_sal");
        $command->bindParam(':fecha_ent', $fecha_entrada);
        $command->bindParam(':fecha_sal', $fecha_salida);
        $list_res = $command->queryAll();


        $command = $connection->createCommand("SELECT reservacion_hab.reservacion,reservacion.fecha_entrada,reservacion_hab.fecha_salida,reservacion_hab.precio from reservacion,reservacion_hab where reservacion.id=reservacion_hab.reservacion   and reservacion.fecha_entrada >=:fecha_ent and reservacion.fecha_entrada <=:fecha_sal GROUP BY reservacion_hab.reservacion");
        $command->bindParam(':fecha_ent', $fecha_entrada);
        $command->bindParam(':fecha_sal', $fecha_salida);
        $list = $command->queryAll();



        $sum_res = 0;
        for ($i = 0; $i < count($list_res); $i++) {
            $start_ts = strtotime($list_res[$i]['fecha_entrada']);
            $end_ts = strtotime($list_res[$i]['fecha_salida']);
            $diferencia = $end_ts - $start_ts;
            $dif_dias = round($diferencia / 86400);
            $sum_res+=$dif_dias * $list_res[$i]['precio'];
        }
        
        

        $sum_util = 0;
        for ($i = 0; $i < count($list); $i++) {
            
            $id = $list[$i]["reservacion"];
            $sum_utilidad = ReservacionServicios::find()->Where(['<', 'estado', 2])->andWhere(['reservacion' => $id])->all();


            for ($k = 0; $k < count($sum_utilidad); $k++) {
                $sum_util+=$sum_utilidad[$k]->precio * $sum_utilidad[$k]->cant;
            }
        }




        
        ?>

        <section class="content">


            <div class="container-fluid">

                <?php if ($logged == 1) { ?>


                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-brown" style="margin-bottom: 0px;height: 70px">

                                <div class="content" style="margin-top: -0.8em" >
                                    <div class="text">INGRESO NETO DEL MES</div>
                                    <div class="number">$ <?php echo $sum_res + $sum_util + $sum_pasadia - $sum_ga ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('gastos/index'); ?>">
                                <div class="info-box bg-grey" style="margin-bottom: 0px;;height: 70px">
                                    <div class="icon" style="margin-top: -0.8em">
                                        <span class="chart chart-line">9,4,6,5,6,4,7,3</span>
                                    </div>
                                    <div class="content" style="margin-top: -0.8em">
                                        <div class="text">GASTOS DEL MES</div>
                                        <div class="number">$ <?php echo $sum_ga ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('reservacion/index'); ?>">
                                <div class="info-box bg-blue-grey" style="margin-bottom: 0px;;height: 70px">
                                    <div class="icon" style="margin-top: -0.8em">
                                        <div class="chart chart-bar">4,6,-3,-1,2,-2,4,3,6,7,-2,3</div>
                                    </div>
                                    <div class="content" style="margin-top: -0.8em">
                                        <div class="text">RESERVACIONES</div>
                                        <div class="number"><?php echo $activas ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('pasadia/create'); ?>">
                                <div class="info-box bg-black" style="margin-bottom: 0px;;height: 70px">
                                    <div class="icon" style="margin-top: -0.8em">
                                        <div class="chart chart-bar">4,6,-3,-1,2,-2,4,3,6,7,-2,3</div>
                                    </div>
                                    <div class="content" style="margin-top: -0.8em">
                                        <div class="text">PASADIAS</div>
                                        <div class="number">$ <?php echo $sum_pasadia ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php } ?>






                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>


                <div id="noti" class="">

                    <?php if (count($notificacionesActivas) > 0) { ?>

                        <div style="margin-bottom: 5px;" id="" class="alert-success alert fade in">

                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                            <strong> <i class="fa fa-check"></i> Aviso!!</strong> Tienes notificaciones sin leer

                        </div>


                    <?php } ?>

                </div>

                <div class="row">
                    <div class="col-md-12">

                        <?= $content ?>

                    </div>
                </div>


            </div>
        </section>



        <?php $this->endBody() ?>

    </body>


</html>
<?php $this->endPage() ?>
