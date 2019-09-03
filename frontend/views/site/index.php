<?php
/* @var $this yii\web\View */

$this->title = 'SISTEMA';
?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Habitacion;
use frontend\assets\AppAsset;
//Estos use son los q t permiten incluir los ficheros js
use yii\web\View;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReservacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CALENDARIO';
$this->params['breadcrumbs'][] = $this->title;
$hab = Habitacion::find()->orderBy('id ASC')->all();

$habitaciones = Habitacion::find()
        ->innerJoin('ocupacion_hab', $on = 'habitacion.id=ocupacion_hab.hab')
        ->orderBy("nombre ASC")
        ->all();

$connection = \Yii::$app->db;
$connection->open();
$command = $connection->createCommand('select habitacion.nombre,habitacion.id as hab,habitacion.color,reservacion.nombre_cliente,reservacion.obs,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida,reservacion.codigo,reservacion.id,agencia.nombre as agencia,plan.nombre as plan,ocupacion.nombre as ocupacion FROM reservacion,habitacion,reservacion_hab,agencia,plan,ocupacion,ocupacion_hab where reservacion.id=reservacion_hab.reservacion and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and reservacion.plan=plan.id and reservacion_hab.ocupacion=ocupacion_hab.id and ocupacion_hab.ocupacion=ocupacion.id  order by reservacion_hab.fecha_entrada,habitacion.id asc');
$reservaciones = $command->queryAll();

$asset = AppAsset::register($this);

//Asi se incluyen ficheros js en una pagina
//$this->registerJsFile($asset->baseUrl . '/js/calendario/jquery-2.2.3.min.js', ['depends' => [JqueryAsset::className()]]);
/* $this->registerJsFile($asset->baseUrl . '/js/calendario/jquery-ui.min.js', ['depends' => [JqueryAsset::className()]]);
  $this->registerJsFile($asset->baseUrl . '/js/calendario/jquery.slimscroll.min.js', ['depends' => [JqueryAsset::className()]]);
  $this->registerJsFile($asset->baseUrl . '/js/calendario/fastclick.min.js', ['depends' => [JqueryAsset::className()]]);
  $this->registerJsFile($asset->baseUrl . '/js/calendario/app.min.js', ['depends' => [JqueryAsset::className()]]);
  $this->registerJsFile($asset->baseUrl . '/js/calendario/demo.js', ['depends' => [JqueryAsset::className()]]);
  $this->registerJsFile($asset->baseUrl . '/js/calendario/moment.min.js', ['depends' => [JqueryAsset::className()]]);
  $this->registerJsFile($asset->baseUrl . '/js/calendario/fullcalendar.min.js', ['depends' => [JqueryAsset::className()]]);
  $this->registerJsFile($asset->baseUrl . '/js/calendario/script.js', ['depends' => [JqueryAsset::className()]]); */

$color = ['#0073b7', '#d7c0c2', '#d3676e', '#c0222d', '#eb0d1d', '#f0c0c3', '#c681e7', '#b7a9be', '#edd6f7', '#86b3e5', '#5a81ac', '#a4bcd6', '#c8e6e9', '#88b6ba'
    , '#31a2ac', '#0dd9eb', '#59d898', '#379365', '#d8e4de', '#c5ed8b', '#8da866', '#6da918', '#ded247', '#b1a738', '#00bbf9', '#00c2ff', '#00ffff', '#ff3cff'];
$posicion = array();
//$color = ['#0073b7', '#3c8dbc', '#39cccc', '#f39c12', '#00a65a', '#01ff70', '#dd4b39', '#605ca8','#7a869d', '#606c84', '#666', '#999', '#00c0ef', '#d2d6de', '#56gt7k', '#3d9970', '#ff851b', '#f012be'];
//$color = ['#0073b7', '#3c8dbc', '#39cccc', '#f39c12', '#00a65a', '#01ff70', '#dd4b39', '#605ca8','#7a869d', '#606c84', '#666', '#999', '#00c0ef', '#d2d6de', '#56gt7k', '#3d9970', '#ff851b', '#f012be', '#k619me', '#n938bf', '#f059ke', '#f062ce', '#i023me', '#f892be', '#p452be', '#f032mn', '#06l65g', '#02h56m', '#68m65j', '#kh565a'];
?>




<div class="row">
    <div class="col-md-12">
        <div class="hold-transition skin-blue sidebar-mini">


            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-body no-padding">


                            <?php

                            function saber_dia($nombredia) {
                                $dias = array("", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB", "DOM");
                                $fecha = $dias[date('N', strtotime($nombredia))];
                                echo $fecha;
                            }

                            $monthNames = array("ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL",
                                "AGO", "SEP", "OCT", "NOV", "DIC");

                            if (!isset($_REQUEST["mes"]))
                                $_REQUEST["mes"] = date("n");
                            if (!isset($_REQUEST["anio"]))
                                $_REQUEST["anio"] = date("Y");

                            $cMonth = $_REQUEST["mes"];
                            $cYear = $_REQUEST["anio"];

                            $prev_year = $cYear;
                            $next_year = $cYear;
                            $prev_month = $cMonth - 1;
                            $next_month = $cMonth + 1;

                            //Se elimino la variante que cambia de año a partir de la seleccion de los meses
                            $prev_year = $cYear - 1;

                            $next_year = $cYear + 1;

                            $fec_com = $cYear . "-" . $cMonth . "-01";

                            if ($cMonth < 10) {
                                $fec_com = $cYear . "-0" . $cMonth . "-01";
                            }
                            ?>


                            <div class="table-responsive p-r-15 p-l-15">
                                <div class="row m-t-10 m-b-10 ">
                                    <div class="col-md-1 col-sm-3 text-left">
                                        <a class="btn btn-primary" href="<?php echo $_SERVER["PHP_SELF"] . "?mes=1" . '' . "&anio=" . $prev_year; ?>" ><strong><?= $prev_year ?></strong></a>
                                    </div> 

                                    <div class="col-md-10 col-sm-6 text-center">

                                        <h3><span class="label label-primary"><strong><?php echo $monthNames[$cMonth - 1] . ' - ' . $cYear; ?></strong></span></h3>



                                    </div> 

                                    <div class="col-md-1 col-sm-3 text-right">
                                        <a class="btn btn-primary" href="<?php echo $_SERVER["PHP_SELF"] . "?mes=1" . '' . "&anio=" . $next_year; ?>" ><strong><?= $next_year ?></strong></a>
                                    </div> 
                                </div> 

                                <div class="row m-t-10 m-b-10 ">


                                    <?php
                                    for ($i = 0; $i < 12; $i++) {
                                        if ($monthNames[$i] == $monthNames[$cMonth - 1]) {
                                            ?>

                                            <div class="col-md-1 col-sm-3 align-justify">
                                                <h3> <span class="label label-primary"><strong><?php echo $monthNames[$i]; ?></strong></span> </h3>
                                            </div>

                                        <?php } else { ?>

                                            <div class="col-md-1 col-sm-3 align-justify">
                                                <a href="<?php echo $_SERVER["PHP_SELF"] . "?mes=" . ($i + 1) . "&anio=" . $cYear; ?>" ><h3> <span class="label label-default"><strong><?php echo $monthNames[$i]; ?></strong></span> </h3></a>
                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>


                                </div> 








                                <style>

                                    .wrap {
                                        width: 100%;
                                    }

                                    .wrap table {
                                        width: 100%;
                                        table-layout: fixed;
                                    }

                                    table tr td {
                                        padding: 5px;
                                        border: 1px solid #eee;
                                        width: 100px;
                                        word-wrap: break-word;
                                    }

                                    table.head tr td {
                                        background: #eee;
                                    }

                                    .inner_table {
                                        height: 500px;
                                        overflow-y: auto;
                                    }
                                </style>

                                <div class="wrap ">
                                    <table class="head">
                                        <tr> 
                                            <td>Dia</td> 

                                            <?php
                                            $nombre = array();
                                            for ($i = 0; $i < count($hab); $i++) {
                                                $nombre[$i] = '';
                                                ?>
                                                <td><?= $hab[$i]->nombre ?></td>
                                            <?php } ?>


                                        </tr> 
                                    </table>
                                    <div class="inner_table">
                                        <table class="table-bordered">


                                            <?php
                                            $timestamp = mktime(0, 0, 0, $cMonth, 1, $cYear);
                                            $maxday = date("t", $timestamp);
                                            $thismonth = getdate($timestamp);
                                            $startday = $thismonth['wday'];



                                            for ($i = 0; $i < ($maxday + $startday); $i++) {
                                                if ($i >= $startday) {
                                                    $cDay = ($i - $startday) + 1;
                                                    // echo $cDay . 'asd'; die;
                                                    ?>
                                                    <tr> 
                                                        <td style="width:61px"  <?php if ((date("d") == $i - $startday + 1) && !isset($_GET['mes'])) { ?> style="background:#999; color:#FFF"<?php } ?>> <?php echo ($i - $startday + 1) . " " ?>/ <?php saber_dia(date('Y-m-d', strtotime($cYear . '-' . $cMonth . '-' . ($i - $startday + 1)))); ?> </td>

                                                        <?php
//                                                            var_dump($reservaciones);die;
//                                                            echo $nombre[0];die;
                                                        $dif_dias = 0;

                                                        for ($j = 0; $j < count($hab); $j++) {
                                                            $td = 0;
                                                            $aux = 0;
                                                            $pintar = 0;
                                                            $row = 1;
//                                                        echo $j.' '.date('Y-m-d', strtotime($cYear . '-' . $cMonth . '-' . ($i - $startday + 1)));
                                                            for ($k = 0; $k < count($reservaciones); $k++) {

                                                                if ($reservaciones[$k]['hab'] == $hab[$j]->id) {
                                                                    if (date('Y-m-d', strtotime($cYear . '-' . $cMonth . '-' . ($i - $startday + 1))) >= date('Y-m-d', strtotime($reservaciones[$k]['fecha_entrada'])) && date('Y-m-d', strtotime($cYear . '-' . $cMonth . '-' . ($i - $startday + 1))) <= date('Y-m-d', strtotime($reservaciones[$k]['fecha_salida']) - 1)) {

                                                                        if ($nombre[$j] != $reservaciones[$k]['nombre_cliente']) {
                                                                            $nombre[$j] = $reservaciones[$k]['nombre_cliente'];
                                                                            $td = 1;





//                                                                        if ($j + 1 < count($hab)) {
//                                                                            $nom = $j;
//                                                                            for ($m = 0; $m < count($reservaciones); $m++) {
//                                                                                if ($reservaciones[$m]['hab'] == $hab[$j + 1]->id) {
//                                                                                    if (date('Y-m-d', strtotime($cYear . '-' . $cMonth . '-' . ($i - $startday + 1))) >= date('Y-m-d', strtotime($reservaciones[$m]['fecha_entrada'])) && date('Y-m-d', strtotime($cYear . '-' . $cMonth . '-' . ($i - $startday + 1))) <= date('Y-m-d', strtotime($reservaciones[$m]['fecha_salida']) - 1)) {
//                                                                                        if ($nombre[$nom] == $reservaciones[$m]['nombre_cliente']) {
//                                                                                            $row++;
//                                                                                            $j+=1;
//                                                                                        }
//                                                                                    }
//                                                                                }
//                                                                            }
//                                                                            //$j=$nom+$row-1;
//                                                                        }



                                                                            if ($pintar == 0) {
                                                                                $pintar = 1;
                                                                                $start_ts = strtotime($reservaciones[$k]['fecha_entrada']);
                                                                                $end_ts = strtotime($reservaciones[$k]['fecha_salida']);
                                                                                $diferencia = $end_ts - $start_ts;
                                                                                $dif_dias = round($diferencia / 86400);



                                                                                if ($reservaciones[$k]['fecha_entrada'] < $fec_com) {
                                                                                    $start_ts = strtotime($reservaciones[$k]['fecha_entrada']);
                                                                                    $start_ts = strtotime($fec_com);
                                                                                    $end_ts = strtotime($reservaciones[$k]['fecha_salida']);
                                                                                    $diferencia = $end_ts - $start_ts;
                                                                                    $dif_dias = round($diferencia / 86400);
                                                                                }

                                                                                $controlador = 0;

                                                                                $valor = rand(0, count($color) - 1);






                                                                                for ($m = 0; $m < count($posicion); $m++) {
                                                                                    if ($posicion[$m]['id'] == $reservaciones[$k]['id']) {
                                                                                        $valor = $posicion[$m]['valor'];
                                                                                        $controlador = 1;
                                                                                        break;
                                                                                    }
                                                                                }

                                                                                if ($controlador == 0) {
                                                                                    $posicion[count($posicion)] = array(
                                                                                        'id' => $reservaciones[$k]['id'],
                                                                                        'valor' => $valor
                                                                                    );
                                                                                }
                                                                                ?>  
                                                                                <td  class="text-center" rowspan='<?= $dif_dias ?>' colspan="<?= $row ?>" style="background-color:<?= $color[$valor] ?>" class="success"> <h5> <?= '- ' . $reservaciones[$k]['agencia'] . ' -' . '<br>  ' . '- ' . $reservaciones[$k]['nombre_cliente'] . ' -' . ' <br> ' . '- ' . $reservaciones[$k]['ocupacion'] . ' -' . ' <br> ' . '- ' . $reservaciones[$k]['obs'] . ' -' ?> </h5></td>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            $td = 1;
                                                                        }
//                                                                    $td = 1;
                                                                    }
                                                                }
                                                            }

                                                            if ($td == 0) {
                                                                echo '<td> </td>';
                                                            }
                                                        }
                                                        ?>

                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </table>
                                    </div>
                                </div>









                                <!-- THE CALENDAR -->

                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                </div>











            </div>
        </div>
    </div>
