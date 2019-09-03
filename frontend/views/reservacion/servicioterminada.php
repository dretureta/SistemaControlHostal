<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\ReservacionServicios;
use frontend\models\ReservacionHab;
use frontend\models\Subservicios;
use frontend\models\Servicio;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */


$asset = AppAsset::register($this);

$this->title = 'ADICIONAR SERVICIOS A: ' . ' ' . $model->nombre_cliente;
$this->params['breadcrumbs'][] = ['label' => 'RESERVACIONES', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$res = new ReservacionServicios();
$mos_res = ReservacionHab::find()->where(['reservacion' => $model->id])->andWhere(['estado' => 0])->orderBy('hab ASC')->all();

$mos_hab = [];
for ($i = 0; $i < count($mos_res); $i++) {
    if ($mos_res[$i]->hab0->nombre != 'ANEXO') {
        $mos_hab[count($mos_hab)] = $mos_res[$i];
    }
}

$fecha = explode('-', $model->fecha_entrada);
$fecha_ent = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

$fecha = explode('-', $model->fecha_salida);
$fecha_sal = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

$mos_res = $mos_hab;

$habitaciones = "";
$precio = "";

$com_hab = array();


for ($i = 0; $i < count($mos_res); $i++) {
    $habitaciones.="HAB: " . $mos_res[$i]->hab0->nombre . " ";
    $precio.=$mos_res[$i]->precio . "<br> ";
    $com_hab[$i]['id'] = $mos_res[$i]->hab;
    $com_hab[$i]['nombre'] = $mos_res[$i]->hab0->nombre;
}
?>

<input type="text" id="check" value="<?php echo $fecha_sal?>" class="hidden">
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info-circle"></i> INFORMACIÓN RESERVA </h3>

            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <h6 style="margin: 5px; border-bottom: 1px dotted #337AB7;">
                            <i class="fa fa-hotel fa-2x"></i> <?php echo $model->nombre_cliente ?>
                        </h6>

                        <div class="row" style="padding-top: 15px; font-size: 12px; line-height: 25px; color: #3b569d;">
                            <div class="col-md-6" style="border-left: 1px dotted #337AB7;">
                                <i class="fa fa-bed"></i> <span class=""><b>ROOM(S): <?php echo $habitaciones ?></b></span><br>
                                <i class="fa fa-users"></i>  <span class=""><b>AGENCIA: <?php echo $model->agencia0->nombre ?></b></span>
                            </div>
                            <div class="col-md-6" style="border-left: 1px dotted #337AB7;">
                                <i class="fa fa-calendar"></i>  <span class=""><b>ENTRADA: <?php echo $fecha_ent ?></b></span><br>
                                <i class="fa fa-calendar"></i> <span class=""><b>SALIDA: <?php echo $fecha_sal ?></b></span>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-3" style="border-left: 1px dotted #337AB7;">
                         <span style="color: #3b4178; font-size: 22px;" class="pull-right">
                             <div class="text-primary">
                                 <i class="fa fa-star text-primary"></i>
                                 <i class="fa fa-star text-primary"></i>
                                 <i class="fa fa-star text-primary"></i>
 
 
                             </div>
                         </span>
 
 
                         <br>
                         <br>
                         <div class="row">
                             <h4 class="pull-right" style="font-size: 20px; font-weight: bold; text-shadow: 1px 2px 0 #FFFFFF; color: #3b4178">
                                 <div class="col-md-12">
                                     <i class="fa fa-dollar"></i> <?= $precio . ' CUC' ?>
                                 </div>
                             </h4>
                         </div>
 
                         <div class="row">
                             <div class="col-md-12">
                                 <h6 class="pull-right" style="color: graytext" >por Noches</h6>
                             </div>
                         </div>
 
                     </div>--!>
                 </div>
 
             </div>
         </div>
 
                    <!-- OTRO PANEL PARA ADICIONAR LOS SERVICIOS-->


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-plus"></i> ADICIONAR SERVICIOS A LA RESERVA </h3>
                        </div>
                        <div class="panel-body">

                            <?php
                            $form = ActiveForm::begin([
                                        'method' => 'post',
                                        'id' => 'res_servcicio',
                                        'action' => ['reservacion/add']]);
                            ?>
                            <div id="respond">
                                <br>
                                <div class="row">
                                    <div class="col-md-12 hidden">
                                        <?= $form->field($res, 'reservacion')->textInput(['maxlength' => true, 'class' => 'form-control', 'value' => $model->id, 'id' => 'res']) ?>
                                    </div>
                                </div>

                                <?php if (count($mos_res) == 1) { ?>
                                    <div class="row">
                                        <div class="col-md-12 hidden">
                                            <?= $form->field($res, 'hab')->textInput(['maxlength' => true, 'class' => 'form-control', 'value' => "", 'name' => 'hab_ide', 'id' => 'combo']) ?>

                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <br>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">hotel</i>
                                                </span>
                                                <div class="form-line">

                                                    <select id="combo" class="form-control" data-combo = "availability" name="hab_ide">
                                                        <option value="">A la Reserva</option>
                                                        <?php
                                                        for ($i = 0; $i < count($com_hab); $i++) {
                                                            ?>
                                                            <option value="<?php echo $com_hab[$i]['id'] ?>"><?php echo $com_hab[$i]['nombre'] ?></option>
                                                        <?php }
                                                        ?>
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>



                                <div class="row">

                                    <div class="col-md-6">
                                        <b>Servicios</b>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">settings</i>
                                            </span>
                                            <div class="form-line">
                                                <select id="id_serv" class="form-control">
                                                    <option value="">Seleccione Servicio</option>
                                                    <?php
                                                    $servicio = Servicio::find()->orderBy("prioridad asc")->all();
                                                    for ($i = 0; $i < count($servicio); $i++) {
                                                        ?>
                                                        <option value="<?php echo $servicio[$i]->id ?>"><?php echo $servicio[$i]->nombre ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Subservicios</b>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">settings</i>
                                            </span>
                                            <div id="subadd" class="form-line">
                                                <input type="text" id="pasadia_sub"  class="form-control" value="Elija primero un servicio">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <b>Precio</b>

                                        <div class="form-group form-float input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">monetization_on</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="preciosub23" name="ReservacionServicios[precio]" class="form-control"   placeholder="" required="" aria-required="true" disabled="true">                                   
                                            </div>
                                        </div>                            
                                    </div>


                                    <div class="col-md-6">                            
                                        <b>Cantidad</b>
                                        <div class="form-group form-float input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">add_circle</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="res_cant" name="ReservacionServicios[cant]" class="form-control"   placeholder="" required="" aria-required="true">                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6" >
                                        <b>No Incluir en Factura</b><br><br>
                                        <div class="switch">
                                            <label><input value="1" name="incluir" id="incluir" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6" >
                                        <b>No Incluir en los ingresos</b><br><br>
                                        <div class="switch">
                                            <label><input value="1" name="rdingresos" id="rdingresos"  type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="btn-success" style= 'height:32px;width: 60%'><i class="fa fa-plus">  </i> ADICIONAR</button>
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="margin-top: 0.8em">
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/index', 'tab' => 0]); ?>" class="btn btn-danger text-center" style="height: 35px;width: 60%"><i class="fa fa-arrow-circle-left">  </i><b> TERMINAR</b></a>

                                    </div>

                                </div>

                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>

                    </div>
                </div>

                <div class="col-md-6">



                    <div class="panel panel-default" id="">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-list"></i> SERVICIOS DE LA RESERVA </h3>
                        </div>
                        <div class="panel-body" style="width: 100%;height: 625px;">
                            <div id="print" width="15%" aling="" >


                                <style>
                                    .wrap table {
                                        width: 100%;
                                        table-layout: fixed;
                                    }

                                    .inner_table {
                                        height: 500px;
                                        overflow-y: auto;
                                    }
                                </style>

                                <div class="wrap ">

<!--                                    <tr style="background-color:#337ab7;color: white;height: 35px"> 
        <th width="85px"><b style="margin-left: 1em">SERVICIO</b></th>
        <th width="32px" style="text-align: center">CANTIDAD</th>
        <th width="32px" style="text-align: center">PRECIO</th>
        <th width="45px" style="text-align: center">IMPORTE</th>
    </tr> -->

                                    <table class="head" border="0" width="230px">
                                        <tr style="background-color:#337ab7;color: white;height: 35px"> 
                                            <th width="100px"><b style="margin-left: 1em">SERVICIO</b></th>
                                            <th width="41px" style="text-align: center">CANTIDAD</th>
                                            <th width="34px" style="text-align: center">PRECIO</th>
                                            <th width="50px" style="text-align: center">IMPORTE</th>
                                        </tr> 
                                    </table>

                                    <div class="inner_table">
                                        <table  class="table-bordered" id="serv">


                                            <?php
                                            $hab = "";

                                            if (isset($_GET['hab'])) {
                                                $hab = $_GET['hab'];
                                            }

                                            $res = $model->id;



                                            $result = array();
                                            $cont = 0;
                                            $imp = 0;

                                            $connection = \Yii::$app->db;
                                            $connection->open();





                                            $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and reservacion_hab.conjunto=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                            $command2->bindParam(':reserva', $res);
                                            $mos_res = $command2->queryAll();
                                            $connection->close();



                                            if (count($mos_res) != 0) {

                                                $start_ts = strtotime($mos_res[0]['fecha_entrada']);
                                                $end_ts = strtotime($mos_res[0]['fecha_salida']);
                                                $diferencia = $end_ts - $start_ts;
                                                $dif_dias = round($diferencia / 86400);

                                                $result[count($result)] = array(
                                                    'desc' => '<b style="font-size: 12px">ALOJAMIENTO</b>',
                                                    'cant' => "",
                                                    'precio' => '',
                                                    'total' => ''
                                                );



                                                $mos_hab = [];
                                                for ($i = 0; $i < count($mos_res); $i++) {
                                                    if ($mos_res[$i]['nombre'] != 'ANEXO') {
                                                        $mos_hab[count($mos_hab)] = $mos_res[$i];
                                                    }
                                                }

                                                $mos_res = $mos_hab;

                                                if ($hab == "") {
                                                    for ($y = 0; $y < count($mos_res); $y++) {


                                                        $start_ts = strtotime($mos_res[$y]['fecha_entrada']);
                                                        $end_ts = strtotime($mos_res[$y]['fecha_salida']);
                                                        $diferencia = $end_ts - $start_ts;
                                                        $dif_dias = round($diferencia / 86400);

                                                        $result[count($result)] = array(
                                                            'desc' => '<p style="margin-left:1em"> HAB ' . $mos_res[$y]['nombre'] . '</p>',
                                                            'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                                                            'precio' => '<p style="margin-left:1em">' . $mos_res[$y]['precio'] . '</p>',
                                                            'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($mos_res[$y]['precio'] * $dif_dias, 2) . '</p>'
                                                        );
                                                        $imp+=$mos_res[$y]['precio'] * $dif_dias;
                                                    }
                                                } else {
                                                    $result[count($result)] = array(
                                                        'desc' => '<p style="margin-left:1em"> HAB ' . $mos_res[0]['nombre'] . '</p>',
                                                        'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                                                        'precio' => '<p style="margin-left:1em">' . $mos_res[0]['precio'] . '</p>',
                                                        'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($mos_res[0]['precio'] * $dif_dias, 2) . '</p>'
                                                    );
                                                    $imp+=$mos_res[0]['precio'] * $dif_dias;
                                                }
                                            } else {

//                            $result[count($result)] = array(
//                                'desc' => '',
//                                'cant' => '',
//                                'precio' => 'TOTAL',
//                                'total' => $imp
//                            );
                                            }


                                            $cont = count($result);

                                            $connection = \Yii::$app->db;
                                            $connection->open();
                                            $command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.nombre ORDER BY servicio.prioridad asc');
                                            $command->bindParam(':reserva', $res);
                                            $command->bindParam(':hab', $hab);
                                            $servicios = $command->queryAll();

                                            if ($hab == "") {
                                                $connection = \Yii::$app->db;
                                                $connection->open();
                                                $command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.nombre ORDER BY servicio.prioridad asc');
                                                $command->bindParam(':reserva', $res);
                                                $servicios = $command->queryAll();
                                            }

                                            for ($i = 0; $i < count($servicios); $i++) {

                                                $command1 = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.nombre ');
                                                $command1->bindParam(':reserva', $res);
                                                $command1->bindParam(':hab', $hab);
                                                $command1->bindParam(':serv', $servicios[$i]['id']);
                                                $subservicios = $command1->queryAll();

                                                if ($hab == "") {
                                                    $command1 = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.nombre');
                                                    $command1->bindParam(':reserva', $res);
                                                    $command1->bindParam(':serv', $servicios[$i]['id']);
                                                    $subservicios = $command1->queryAll();
                                                }


                                                $result[count($result)] = array(
                                                    'desc' => "<b style='font-size: 12px';margin-left:-3em'>" . $servicios[$i]['nombre'] . "</b>",
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
                                                'precio' => '<h6 style="margin-left:1em">' . 'TOTAL' . '</h6>',
                                                'total' => '<h6 style="margin-left:1em">' . Yii::$app->formatter->asDecimal($imp, 2) . '</h6>'
                                            );

                                            for ($i = 0; $i < count($result); $i++) {
                                                ?>
                                                <tr style="width: 230px">
                                                    <td style="width: 105px"><?php echo $result[$i]['desc'] ?></td>
                                                    <td style="width: 40px"><?php echo $result[$i]['cant'] ?></td>
                                                    <td style="width: 40px"><?php echo $result[$i]['precio'] ?></td>
                                                    <td style="width: 45px"><?php echo $result[$i]['total'] ?></td>
                                                </tr>
                                            <?php }
                                            ?>


                                        </table>


                                        <br>

                                        <?php
                                        $id_res = $model->id;

                                        $command = $connection->createCommand('select habitacion.id,habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion_hab.conjunto=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                        $command->bindParam(':reserva', $id_res);
                                        $mostrar_res = $command->queryAll();

                                        $command = $connection->createCommand('select habitacion.id,habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva  GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                        $command->bindParam(':reserva', $id_res);
                                        $mostrar_res1 = $command->queryAll();

                                        $connection->close();

                                        $mostrar_hab = [];
                                        for ($i = 0; $i < count($mostrar_res); $i++) {
                                            if ($mostrar_res[$i]['nombre'] != 'ANEXO') {
                                                $mostrar_hab[count($mostrar_hab)] = $mostrar_res[$i];
                                            }
                                        }


                                        $mostrar_hab1 = [];
                                        for ($i = 0; $i < count($mostrar_res1); $i++) {
                                            if ($mostrar_res1[$i]['nombre'] != 'ANEXO') {
                                                $mostrar_hab1[count($mostrar_hab1)] = $mostrar_res1[$i];
                                            }
                                        }

                                        $mostrar_res = $mostrar_hab;
                                        $mostrar_res1 = $mostrar_hab1;



                                        for ($i = 0; $i < count($mostrar_hab1); $i++) {
                                            $total = 0;
                                            ?>
                                            <table class="table-bordered hidden" id="<?php echo $mostrar_hab1[$i]['id'] ?>" style="margin-top: -1.5em">


                                                <?php
                                                //print_r($total);die;
                                                if (count($mostrar_res) != 0) {

                                                    //if ($mostrar_res1[$i]['conjunto'] != 0) {

                                                    $start_ts = strtotime($mostrar_res1[$i]['fecha_entrada']);
                                                    $end_ts = strtotime($mostrar_res1[$i]['fecha_salida']);
                                                    $diferencia = $end_ts - $start_ts;
                                                    $dif_dias = round($diferencia / 86400);

                                                    $total = $dif_dias * $mostrar_res1[$i]['precio'];
                                                    ?>


                                                    <tr style="width: 230px">                                        
                                                        <th style="width: 105px"><b style="text-align: justify">ALOJAMIENTO</b></th>
                                                        <th style="width: 40px"></th>
                                                        <th style="width: 40px"></th>
                                                        <th style="width: 45px"></th>
                                                    </tr>




                                                    <tr>                                        
                                                        <td style="width: 105px"> <p style="text-align: justify;margin-left: 1em"> HAB <?php echo $mostrar_res1[$i]['nombre'] ?> </p> </td>
                                                        <td style="width: 40px"><p style="margin-left:1em"><?php echo $dif_dias ?></p></td>
                                                        <td style="width: 40px"><p style="margin-left:1em"><?php echo $mostrar_res1[$i]['precio'] ?></p></td>
                                                        <td style="width: 45px"><p style="margin-left:1em"><?php echo Yii::$app->formatter->asDecimal($dif_dias * $mostrar_res1[$i]['precio'], 2) ?></p></td>
                                                    </tr>
                                                    <?php
                                                }
                                                //}


                                                $hab = $mostrar_hab1[$i]['id'];
                                                $command = $connection->createCommand('select servicio.id,servicio.nombre,servicio.prioridad FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.nombre ORDER BY servicio.prioridad asc');
                                                $command->bindParam(':reserva', $id_res);
                                                $command->bindParam(':hab', $hab);
                                                $servicios = $command->queryAll();

                                                //print_r($servicios[0]['nombre']);die;



                                                for ($k = 0; $k < count($servicios); $k++) {
                                                    ?>
                                                    <tr style="width: 230px">
                                                        <th style="width: 105px"><b style="text-align: justify"><?php echo $servicios[$k]['nombre'] ?></b></th>
                                                        <th style="width: 40px"></th>
                                                        <th style="width: 40px"></th>
                                                        <th style="width: 45px"></th>
                                                    </tr>
                                                    <?php
                                                    $command = $connection->createCommand('select subservicios.nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.nombre');
                                                    $command->bindParam(':reserva', $id_res);
                                                    $command->bindParam(':hab', $hab);
                                                    $command->bindParam(':serv', $servicios[$k]['id']);
                                                    $subservicios = $command->queryAll();

                                                    for ($m = 0; $m < count($subservicios); $m++) {
                                                        $total+=$subservicios[$m]['total'];
                                                        ?>
                                                        <tr style="width: 230px">
                                                            <td style="width: 105px"><p style="margin-left: 1em"> <?php echo $subservicios[$m]['nombre'] ?> </p></td>
                                                            <td style="width: 40px"><p style="margin-left:2em"><?php echo $subservicios[$m]['cant'] ?></p></td>
                                                            <td style="width: 40px"><p style="margin-left:1em"><?php echo $subservicios[$m]['precio'] ?></p></td>
                                                            <td style="width:45px"><p style="margin-left:1em"><?php echo Yii::$app->formatter->asDecimal($subservicios[$m]['total'], 2) ?></p></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <tr style="width: 230px">
                                                    <th style="width: 105px"></th>
                                                    <th style="width: 40px"></th>
                                                    <th style="width: 40px"><h6 style="margin-left:1em;"> TOTAL </h6></th>
                                                <th style="width: 45px"><h6 style="margin-left:1em;"><?php echo Yii::$app->formatter->asDecimal($total, 2) ?></h6></th>
                                                </tr>
                                            </table>

                                        <?php } ?>
                                    </div>





                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-2 text-center" style="margin-top: -1em">
                                    <b>Ingles</b><br>
                                    <div class="switch">
                                        <label><input name="ingles" id="ingles" type="checkbox"><span class="lever switch-col-indigo text-right"></span></label>

                                    </div>
                                </div>
                                <div class="col-md-2 text-center" style="margin-top: -1em">
                                    <b>Frances</b><br>
                                    <div class="switch">
                                        <label><input name="frances" id="frances" type="checkbox"><span class="lever switch-col-indigo text-right"></span></label>
                                    </div>
                                </div>

                                <div class="col-md-3  text-center" >
                                    <p><a class="btn btn-primary" href="javascript:imprSelec('Imprime')" >IMPRIMIR</a></p>

                                </div>

                                <div class="col-md-2  text-left" >
                                    <p><a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/infores', 'id' => $model->id]); ?>" class="btn btn-primary">INFO</a></p>
                                </div>

                                <div class="col-md-3  text-right" >
                                    <p><a onclick="return prueba()" href="<?= \Yii::$app->urlManager->createUrl(['reservacion/checkout', 'id' => $model->id]); ?>" class="btn btn-danger" >CHECK OUT</a></p>

                                </div>


                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>




            <style type="text/css" media="print">
                .Imprime {
                    height: auto;
                    width: 210px;
                    margin: 0px;
                    padding: 0px;
                    float: left;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 6px;
                    font-style: normal;
                    line-height: normal;
                    font-weight: normal;
                    font-variant: normal;
                    text-transform: none;
                    color: #000;
                }
                @page{
                    margin: 0;
                }
            </style>




            <!--            ESTO ES LO Q VOY A IMPRIMIR EN DEPENDENCIA D LA ACCION SELECIONADA EN EL 
                        RADIO BUTTON-->

            <div class="row hidden">

                <?php
                $hab = "";

                if (isset($_GET['hab'])) {
                    $hab = $_GET['hab'];
                }

                $res = $model->id;

                $result = array();
                $cont = 0;
                $imp = 0;

                $connection = \Yii::$app->db;
                $connection->open();




                $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion_hab.conjunto=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                $command2->bindParam(':reserva', $res);
                $command2->bindParam(':hab', $hab);
                $mos_res = $command2->queryAll();
                $connection->close();

                if ($hab == "") {
                    $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and reservacion_hab.conjunto=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                    $command2->bindParam(':reserva', $res);
                    $mos_res = $command2->queryAll();
                    $connection->close();
                }
                $habitaciones = "";

                $mos_hab = ReservacionHab::find()->where(['reservacion' => $res])->all();
//print_r(count($mos_hab));die;



                for ($i = 0; $i < count($mos_hab); $i++) {
                    if ($i < count($mos_hab) - 1) {
                        $habitaciones.=$mos_hab[$i]->hab0->nombre . ", ";
                    } else {
                        $habitaciones.=$mos_hab[$i]->hab0->nombre . " ";
                    }
                }
                ?>

                <div class="col-md-4">
                    <div id="imp_espanol" class="Imprime" style="width: 230px;" >
                        -----------------------------------------------------------------------------
                        <div style="margin-left:7em"><b>  HACIENDA "LA CASONA" </b></div>  
                        -----------------------------------------------------------------------------<br>
                        <p style="margin-left: 1em">
                            Cliente: <?php echo $model->nombre_cliente ?>  <br>
                            Fecha Entrada: <?php echo $fecha_ent ?><br>
                            Fecha Salida: <?php echo $fecha_sal ?><br>
                            Habitacion(es): <?php echo $habitaciones ?><br><br>
                        </p>
                        <table border="0">
                            <thead >
                                <tr>
                                    <th width="130px" style="text-align: justify;text-decoration: underline;">SERVICIO</th>
                                    <th width="30px" style="text-decoration: underline;">CANTIDAD</th>
                                    <th <th style="margin-left:0.5em;text-decoration: underline;" width="25px">PRECIO</th>
                                    <th width="45px" style="text-decoration: underline;">IMPORTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $hab = "";

                                if (isset($_GET['hab'])) {
                                    $hab = $_GET['hab'];
                                }

                                $res = $model->id;

                                $result = array();
                                $cont = 0;
                                $imp = 0;

                                $connection = \Yii::$app->db;
                                $connection->open();




                                $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and  reservacion_hab.conjunto=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                $command2->bindParam(':reserva', $res);
                                $command2->bindParam(':hab', $hab);
                                $mos_res = $command2->queryAll();
                                $connection->close();

                                if ($hab == "") {
                                    $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and reservacion_hab.conjunto=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                    $command2->bindParam(':reserva', $res);
                                    $mos_res = $command2->queryAll();
                                    $connection->close();
                                }


                                if (count($mos_res) != 0) {

                                    $start_ts = strtotime($mos_res[0]['fecha_entrada']);
                                    $end_ts = strtotime($mos_res[0]['fecha_salida']);
                                    $diferencia = $end_ts - $start_ts;
                                    $dif_dias = round($diferencia / 86400);


                                    $mos_hab = [];
                                    for ($i = 0; $i < count($mos_res); $i++) {
                                        if ($mos_res[$i]['nombre'] != 'ANEXO') {
                                            $mos_hab[count($mos_hab)] = $mos_res[$i];
                                        }
                                    }

                                    $mos_res = $mos_hab;


                                    $result[count($result)] = array(
                                        'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify"> ALOJAMIENTO </b>
                                            </td>
                                        </tr>
                                    </table>',
                                        'cant' => "",
                                        'precio' => '',
                                        'total' => ''
                                    );

                                    if ($hab == "") {
                                        for ($y = 0; $y < count($mos_res); $y++) {


                                            $start_ts = strtotime($mos_res[$y]['fecha_entrada']);
                                            $end_ts = strtotime($mos_res[$y]['fecha_salida']);
                                            $diferencia = $end_ts - $start_ts;
                                            $dif_dias = round($diferencia / 86400);

                                            $pr = $mos_res[$y]['precio'] * $dif_dias;


                                            $result[count($result)] = array(
                                                'desc' => '<table  style="width: 120">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify"> HAB ' . $mos_res[$y]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                                'cant' => '<p style="margin-left:2em"> ' . $dif_dias . '</p>',
                                                'precio' => '<p style="">' . $mos_res[$y]['precio'] . '</p>',
                                                'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($pr, 2) . '</p>'
                                            );
                                            $imp+=$mos_res[$y]['precio'] * $dif_dias;
                                        }
                                    } else {
                                        $pr = $mos_res[0]['precio'] * $dif_dias;
                                        $result[count($result)] = array(
                                            'desc' => '<table  style="width: 120;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify"> HAB ' . $mos_res[0]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                            'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                                            'precio' => '<p style="">' . $mos_res[0]['precio'] . '</p>',
                                            'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($pr, 2) . '</p>'
                                        );
                                        $imp+=$mos_res[0]['precio'] * $dif_dias;
                                    }

//                            $result[count($result)] = array(
//                                'desc' => '',
//                                'cant' => '',
//                                'precio' => 'TOTAL',
//                                'total' => $imp
//                            );
                                } else {

//                            $result[count($result)] = array(
//                                'desc' => '',
//                                'cant' => '',
//                                'precio' => 'TOTAL',
//                                'total' => $imp
//                            );
                                }


                                $cont = count($result);

                                $connection = \Yii::$app->db;
                                $connection->open();
                                $command = $connection->createCommand('select servicio.id,servicio.nombre as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.ingles ORDER BY servicio.prioridad asc');
                                $command->bindParam(':reserva', $res);
                                $command->bindParam(':hab', $hab);
                                $servicios = $command->queryAll();

                                if ($hab == "") {
                                    $connection = \Yii::$app->db;
                                    $connection->open();
                                    $command = $connection->createCommand('select servicio.id,servicio.nombre as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.ingles ORDER BY servicio.prioridad');
                                    $command->bindParam(':reserva', $res);
                                    $servicios = $command->queryAll();
                                }

                                for ($i = 0; $i < count($servicios); $i++) {

                                    $command1 = $connection->createCommand('select subservicios.nombre as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.ingles ');
                                    $command1->bindParam(':reserva', $res);
                                    $command1->bindParam(':hab', $hab);
                                    $command1->bindParam(':serv', $servicios[$i]['id']);
                                    $subservicios = $command1->queryAll();

                                    if ($hab == "") {
                                        $command1 = $connection->createCommand('select subservicios.nombre as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.ingles');
                                        $command1->bindParam(':reserva', $res);
                                        $command1->bindParam(':serv', $servicios[$i]['id']);
                                        $subservicios = $command1->queryAll();
                                    }


                                    $result[$cont] = array(
                                        'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify"> ' . $servicios[$i]['nombre'] . ' </b>
                                            </td>
                                        </tr>
                                    </table>',
                                        'cant' => ' ',
                                        'precio' => ' ',
                                        'total' => ' '
                                    );
                                    $cont++;

                                    for ($k = 0; $k < count($subservicios); $k++) {
                                        $result[$cont] = array(
                                            'desc' => '<table  style="width: 120">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify">' . $subservicios[$k]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                            'cant' => '<p style="margin-left:2em">' . $subservicios[$k]['cant'] . '</p>',
                                            'precio' => '<p style="">' . $subservicios[$k]['precio'] . '</p>',
                                            'total' => '<p style="margin-left:1em">' . $subservicios[$k]['total'] . '</p>'
                                        );
                                        $cont++;
                                        $imp+=$subservicios[$k]['total'];
                                    }
                                }

                                $result[count($result)] = array(
                                    'desc' => '',
                                    'cant' => '<b style="text-decoration: underline;"> TOTAL</b>',
                                    'precio' => '<b style="text-decoration: underline;">(CUC)</b>',
                                    'total' => '<b style="margin-left:1em;text-decoration: underline;">' . Yii::$app->formatter->asDecimal($imp, 2) . ' </b>'
                                );

                                for ($i = 0; $i < count($result); $i++) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result[$i]['desc'] ?></td>
                                        <td ><?php echo $result[$i]['cant'] ?></td>
                                        <td><?php echo $result[$i]['precio'] ?></td>
                                        <td><?php echo $result[$i]['total'] ?></td>
                                    </tr>
                                <?php }
                                ?>

                            </tbody>
                        </table>
                        <p style="margin-left:1.5em"><b style='font-size: 12px'>"El servicio esta incluido, mas, aceptamos propina"</b></p>
                        <p style="margin-left:6em"><b>"GRACIAS POR VISITARNOS"</b></p>
                        <p></p>
                    </div>
                </div>


                <div class="col-md-4">
                    <div id="imp_ingles" class="Imprime" style="width: 230px;">


                        -----------------------------------------------------------------------------
                        <div style="margin-left:7em"><b>  HACIENDA "LA CASONA" </b></div>  
                        -----------------------------------------------------------------------------<br>
                        <p style="margin-left: 1em">
                            Client: <?php echo $model->nombre_cliente ?>  <br>
                            Check-In: <?php echo $fecha_ent ?><br>
                            Check-Out: <?php echo $fecha_sal ?><br>
                            Room(s): <?php echo $habitaciones ?><br><br>
                        </p>
                        <table border="0">
                            <thead >
                                <tr>
                                    <th width="130px" style="text-align: justify;text-decoration: underline;">SERVICE</th>
                                    <th width="30px" style="text-decoration: underline;">QUANTITY</th>
                                    <th <th style="margin-left:0.5em;text-decoration: underline;" width="25px">PRICE</th>
                                    <th width="45px" style="text-decoration: underline;">AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $hab = "";

                                if (isset($_GET['hab'])) {
                                    $hab = $_GET['hab'];
                                }

                                $res = $model->id;

                                $result = array();
                                $cont = 0;
                                $imp = 0;

                                $connection = \Yii::$app->db;
                                $connection->open();




                                $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and  reservacion_hab.conjunto=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                $command2->bindParam(':reserva', $res);
                                $command2->bindParam(':hab', $hab);
                                $mos_res = $command2->queryAll();
                                $connection->close();

                                if ($hab == "") {
                                    $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and reservacion_hab.conjunto=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                    $command2->bindParam(':reserva', $res);
                                    $mos_res = $command2->queryAll();
                                    $connection->close();
                                }


                                if (count($mos_res) != 0) {

                                    $start_ts = strtotime($mos_res[0]['fecha_entrada']);
                                    $end_ts = strtotime($mos_res[0]['fecha_salida']);
                                    $diferencia = $end_ts - $start_ts;
                                    $dif_dias = round($diferencia / 86400);


                                    $mos_hab = [];
                                    for ($i = 0; $i < count($mos_res); $i++) {
                                        if ($mos_res[$i]['nombre'] != 'ANEXO') {
                                            $mos_hab[count($mos_hab)] = $mos_res[$i];
                                        }
                                    }

                                    $mos_res = $mos_hab;


                                    $result[count($result)] = array(
                                        'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify"> LODGING </b>
                                            </td>
                                        </tr>
                                    </table>',
                                        'cant' => "",
                                        'precio' => '',
                                        'total' => ''
                                    );

                                    if ($hab == "") {
                                        for ($y = 0; $y < count($mos_res); $y++) {


                                            $start_ts = strtotime($mos_res[$y]['fecha_entrada']);
                                            $end_ts = strtotime($mos_res[$y]['fecha_salida']);
                                            $diferencia = $end_ts - $start_ts;
                                            $dif_dias = round($diferencia / 86400);

                                            $pr = $mos_res[$y]['precio'] * $dif_dias;


                                            $result[count($result)] = array(
                                                'desc' => '<table  style="width: 120">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify"> ROOM ' . $mos_res[$y]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                                'cant' => '<p style="margin-left:2em"> ' . $dif_dias . '</p>',
                                                'precio' => '<p style="">' . $mos_res[$y]['precio'] . '</p>',
                                                'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($pr, 2) . '</p>'
                                            );
                                            $imp+=$mos_res[$y]['precio'] * $dif_dias;
                                        }
                                    } else {
                                        $pr = $mos_res[0]['precio'] * $dif_dias;
                                        $result[count($result)] = array(
                                            'desc' => '<table  style="width: 120">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify"> ROOM ' . $mos_res[0]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                            'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                                            'precio' => '<p style="">' . $mos_res[0]['precio'] . '</p>',
                                            'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($pr, 2) . '</p>'
                                        );
                                        $imp+=$mos_res[0]['precio'] * $dif_dias;
                                    }

//                            $result[count($result)] = array(
//                                'desc' => '',
//                                'cant' => '',
//                                'precio' => 'TOTAL',
//                                'total' => $imp
//                            );
                                } else {

//                            $result[count($result)] = array(
//                                'desc' => '',
//                                'cant' => '',
//                                'precio' => 'TOTAL',
//                                'total' => $imp
//                            );
                                }


                                $cont = count($result);

                                $connection = \Yii::$app->db;
                                $connection->open();
                                $command = $connection->createCommand('select servicio.id,servicio.ingles as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.ingles ORDER BY servicio.prioridad asc');
                                $command->bindParam(':reserva', $res);
                                $command->bindParam(':hab', $hab);
                                $servicios = $command->queryAll();

                                if ($hab == "") {
                                    $connection = \Yii::$app->db;
                                    $connection->open();
                                    $command = $connection->createCommand('select servicio.id,servicio.ingles as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.ingles ORDER BY servicio.prioridad');
                                    $command->bindParam(':reserva', $res);
                                    $servicios = $command->queryAll();
                                }

                                for ($i = 0; $i < count($servicios); $i++) {

                                    $command1 = $connection->createCommand('select subservicios.ingles as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.ingles ');
                                    $command1->bindParam(':reserva', $res);
                                    $command1->bindParam(':hab', $hab);
                                    $command1->bindParam(':serv', $servicios[$i]['id']);
                                    $subservicios = $command1->queryAll();

                                    if ($hab == "") {
                                        $command1 = $connection->createCommand('select subservicios.ingles as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.ingles');
                                        $command1->bindParam(':reserva', $res);
                                        $command1->bindParam(':serv', $servicios[$i]['id']);
                                        $subservicios = $command1->queryAll();
                                    }


                                    $result[$cont] = array(
                                        'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify"> ' . $servicios[$i]['nombre'] . ' </b>
                                            </td>
                                        </tr>
                                    </table>',
                                        'cant' => ' ',
                                        'precio' => ' ',
                                        'total' => ' '
                                    );
                                    $cont++;

                                    for ($k = 0; $k < count($subservicios); $k++) {
                                        $result[$cont] = array(
                                            'desc' => '<table  style="width: 120">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify">' . $subservicios[$k]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                            'cant' => '<p style="margin-left:2em">' . $subservicios[$k]['cant'] . '</p>',
                                            'precio' => '<p style="">' . $subservicios[$k]['precio'] . '</p>',
                                            'total' => '<p style="margin-left:1em">' . $subservicios[$k]['total'] . '</p>'
                                        );
                                        $cont++;
                                        $imp+=$subservicios[$k]['total'];
                                    }
                                }

                                $result[count($result)] = array(
                                    'desc' => '',
                                    'cant' => '<b style="text-decoration: underline;"> TOTAL AMOUNT</b>',
                                    'precio' => '<b style="text-decoration: underline;">(CUC)</b>',
                                    'total' => '<b style="margin-left:1em;text-decoration: underline;">' . Yii::$app->formatter->asDecimal($imp, 2) . ' </b>'
                                );

                                for ($i = 0; $i < count($result); $i++) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result[$i]['desc'] ?></td>
                                        <td ><?php echo $result[$i]['cant'] ?></td>
                                        <td><?php echo $result[$i]['precio'] ?></td>
                                        <td><?php echo $result[$i]['total'] ?></td>
                                    </tr>
                                <?php }
                                ?>

                            </tbody>
                        </table>
                        <p style="margin-left:3.5em"><b style="font-size: 12px; margin-left:2em">"Service is included but we accept tips"</b></p>
                        <p style="margin-left:6em"><b style=" margin-left:2em">"THANKS FOR VISITING US"</b></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div id="imp_frances" class="Imprime" style="width: 230px;">
                        -----------------------------------------------------------------------------
                        <div style="margin-left:7em"><b>  HACIENDA "LA CASONA" </b></div> 
                        -----------------------------------------------------------------------------<br>
                        <p style="margin-left: 0.5em">
                            Cliente: <?php echo $model->nombre_cliente ?>  <br>
                            Fecha Entrada: <?php echo $fecha_ent ?><br>
                            Fecha Salida: <?php echo $fecha_sal ?><br>
                            Chambre(s): <?php echo $habitaciones ?><br><br></p>
                        <table  border='0'>
                            <thead >
                                <tr>
                                    <th width="120px" style="text-align: justify;text-decoration: underline;">SERVICE</th>
                                    <th width="30px" style="text-decoration: underline;">QUANTITÉ</th>
                                    <th style="margin-left:0.5em;text-decoration: underline;" width="30px">PRIX</th>
                                    <th width="50px" style="text-decoration: underline;">MONTANT</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $hab = "";

                                if (isset($_GET['hab'])) {
                                    $hab = $_GET['hab'];
                                }

                                $res = $model->id;

                                $result = array();
                                $cont = 0;
                                $imp = 0;

                                $connection = \Yii::$app->db;
                                $connection->open();




                                $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id and reservacion_hab.hab=:hab AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and reservacion_hab.conjunto=1 GROUP BY reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                $command2->bindParam(':reserva', $res);
                                $command2->bindParam(':hab', $hab);
                                $mos_res = $command2->queryAll();
                                $connection->close();

                                if ($hab == "") {
                                    $command2 = $connection->createCommand('select habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and reservacion_hab.conjunto=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                                    $command2->bindParam(':reserva', $res);
                                    $mos_res = $command2->queryAll();
                                    $connection->close();
                                }


                                if (count($mos_res) != 0) {

                                    $start_ts = strtotime($mos_res[0]['fecha_entrada']);
                                    $end_ts = strtotime($mos_res[0]['fecha_salida']);
                                    $diferencia = $end_ts - $start_ts;
                                    $dif_dias = round($diferencia / 86400);



                                    $mos_hab = [];
                                    for ($i = 0; $i < count($mos_res); $i++) {
                                        if ($mos_res[$i]['nombre'] != 'ANEXO') {
                                            $mos_hab[count($mos_hab)] = $mos_res[$i];
                                        }
                                    }

                                    $mos_res = $mos_hab;



                                    $result[count($result)] = array(
                                        'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify">LOGEMENT</b>
                                            </td>
                                        </tr>
                                    </table>',
                                        'cant' => "",
                                        'precio' => '',
                                        'total' => ''
                                    );

                                    if ($hab == "") {
                                        for ($y = 0; $y < count($mos_res); $y++) {


                                            $start_ts = strtotime($mos_res[$y]['fecha_entrada']);
                                            $end_ts = strtotime($mos_res[$y]['fecha_salida']);
                                            $diferencia = $end_ts - $start_ts;
                                            $dif_dias = round($diferencia / 86400);

                                            $pr = $mos_res[$y]['precio'] * $dif_dias;

                                            $result[count($result)] = array(
                                                'desc' => '<table  style="width: 120">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify"> CHAMBRE ' . $mos_res[$y]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                                'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                                                'precio' => '<p style="">' . $mos_res[$y]['precio'] . '</p>',
                                                'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($pr, 2) . '</p>'
                                            );
                                            $imp+=$mos_res[$y]['precio'] * $dif_dias;
                                        }
                                    } else {
                                        $pr = $mos_res[0]['precio'] * $dif_dias;
                                        $result[count($result)] = array(
                                            'desc' => '<table  style="width: 120">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify"> CHAMBRE ' . $mos_res[0]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                            'cant' => '<p style="margin-left:2em">' . $dif_dias . '</p>',
                                            'precio' => '<p style="">' . $mos_res[0]['precio'] . '</p>',
                                            'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($pr, 2) . '</p>'
                                        );
                                        $imp+=$mos_res[0]['precio'] * $dif_dias;
                                    }

//                            $result[count($result)] = array(
//                                'desc' => '',
//                                'cant' => '',
//                                'precio' => 'TOTAL',
//                                'total' => $imp
//                            );
                                } else {

//                            $result[count($result)] = array(
//                                'desc' => '',
//                                'cant' => '',
//                                'precio' => 'TOTAL',
//                                'total' => $imp
//                            );
                                }


                                $cont = count($result);

                                $connection = \Yii::$app->db;
                                $connection->open();
                                $command = $connection->createCommand('select servicio.id,servicio.frances as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.frances ORDER BY servicio.prioridad asc');
                                $command->bindParam(':reserva', $res);
                                $command->bindParam(':hab', $hab);
                                $servicios = $command->queryAll();

                                if ($hab == "") {
                                    $connection = \Yii::$app->db;
                                    $connection->open();
                                    $command = $connection->createCommand('select servicio.id,servicio.frances as nombre FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.frances ORDER BY servicio.prioridad asc');
                                    $command->bindParam(':reserva', $res);
                                    $servicios = $command->queryAll();
                                }

                                for ($i = 0; $i < count($servicios); $i++) {

                                    $command1 = $connection->createCommand('select subservicios.frances as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.frances ');
                                    $command1->bindParam(':reserva', $res);
                                    $command1->bindParam(':hab', $hab);
                                    $command1->bindParam(':serv', $servicios[$i]['id']);
                                    $subservicios = $command1->queryAll();

                                    if ($hab == "") {
                                        $command1 = $connection->createCommand('select subservicios.frances as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.frances');
                                        $command1->bindParam(':reserva', $res);
                                        $command1->bindParam(':serv', $servicios[$i]['id']);
                                        $subservicios = $command1->queryAll();
                                    }


                                    $result[$cont] = array(
                                        'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify">' . $servicios[$i]['nombre'] . '</b>
                                            </td>
                                        </tr>
                                    </table>',
                                        'cant' => ' ',
                                        'precio' => ' ',
                                        'total' => ' '
                                    );
                                    $cont++;

                                    for ($k = 0; $k < count($subservicios); $k++) {
                                        $result[$cont] = array(
                                            'desc' => '<table  style="width: 120">
                                        <tr>
                                            <td style="width: 5">

                                            </td>
                                            <td style="width: 115">
                                                <p style="text-align: justify">' . $subservicios[$k]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                            'cant' => '<p style="margin-left:2em">' . $subservicios[$k]['cant'] . '</p>',
                                            'precio' => '<p style="">' . $subservicios[$k]['precio'] . '</p>',
                                            'total' => '<p style="margin-left:1em">' . $subservicios[$k]['total'] . '</p>'
                                        );
                                        $cont++;
                                        $imp+=$subservicios[$k]['total'];
                                    }
                                }

                                $result[count($result)] = array(
                                    'desc' => '',
                                    'cant' => '<b style="text-decoration: underline;"> MONTANT TOTAL</b>',
                                    'precio' => '<b style="text-decoration: underline;">(CUC)</b>',
                                    'total' => '<b style="margin-left:1em;text-decoration: underline;">' . Yii::$app->formatter->asDecimal($imp, 2) . '</b>'
                                );

                                for ($i = 0; $i < count($result); $i++) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result[$i]['desc'] ?></td>
                                        <td><?php echo $result[$i]['cant'] ?></td>
                                        <td><?php echo $result[$i]['precio'] ?></td>
                                        <td><?php echo $result[$i]['total'] ?></td>
                                    </tr>
                                <?php }
                                ?>

                            </tbody>
                        </table>
                        <p style="margin-left:3.7em"><b style='font-size: 12px'>"Service inclus, mais acceptons pourboire"</b></p>
                        <p style="margin-left:5em"><b>"MERCI DE VOTRE VISITE"</b></p>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="row hidden">
                <?php
//                $mos_res = ReservacionHab::find()->where(['reservacion' => $model->id])->andWhere(['estado' => 0])->orderBy('hab ASC')->all();
//                


                $id_res = $model->id;
                $command = $connection->createCommand('select habitacion.id,habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion_hab.conjunto=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                $command->bindParam(':reserva', $id_res);
                $mos_res = $command->queryAll();

                $command = $connection->createCommand('select habitacion.id,habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
                $command->bindParam(':reserva', $id_res);
                $mos_res1 = $command->queryAll();




                $connection->close();



                $mos_hab = [];
                for ($i = 0; $i < count($mos_res); $i++) {
                    if ($mos_res[$i]['nombre'] != 'ANEXO') {
                        $mos_hab[count($mos_hab)] = $mos_res[$i];
                    }
                }


                $mos_hab1 = [];
                for ($i = 0; $i < count($mos_res1); $i++) {
                    if ($mos_res1[$i]['nombre'] != 'ANEXO') {
                        $mos_hab1[count($mos_hab1)] = $mos_res1[$i];
                    }
                }




                $mos_res = $mos_hab;
                $mos_res1 = $mos_hab1;





                for ($i = 0; $i < count($mos_hab1); $i++) {
                    $total = 0;
                    ?>

                    <div class="col-md-4">
                        <div id="<?= $mos_hab1[$i]['id'] . '_espanol' ?>" class="Imprime" style="width: 230px;">
                            -----------------------------------------------------------------------------
                            <div style="margin-left:7em"><b>  HACIENDA "LA CASONA" </b></div>                       -----------------------------------------------------------------------------<br>
                            <p style="margin-left: 0.5em"> Cliente: <?php echo $model->nombre_cliente ?>  <br>
                                Fecha Entrada: <?php echo $fecha_ent ?><br>
                                Fecha Salida: <?php echo $fecha_sal ?><br>
                                Habitacion(es): <?php echo $mos_hab1[$i]['nombre'] ?><br><br></p>
                            <table border='0'>
                                <tr>
                                    <th width="130px" style="text-align:justify;text-decoration: underline;">SERVICIO</th>
                                    <th width="30px" style="text-decoration: underline;">CANTIDAD</th>
                                    <th width="25px" style="margin-left: 0.5em;text-decoration: underline;">PRECIO</th>
                                    <th width="45px" style="text-decoration: underline;">IMPORTE</th>
                                </tr>
                                <?php
                                if (count($mos_res) != 0) {

                                    $start_ts = strtotime($mos_res1[$i]['fecha_entrada']);
                                    $end_ts = strtotime($mos_res1[$i]['fecha_salida']);
                                    $diferencia = $end_ts - $start_ts;
                                    $dif_dias = round($diferencia / 86400);

                                    $total = $dif_dias * $mos_res1[$i]['precio'];
                                    ?>
                                    <tr>
                                        <th width="120px" style="text-align: justify;margin-left: 3em"><b>ALOJAMIENTO</b></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th >
                                    <table  style="width: 120;text-align: justify">
                                        <tr>
                                            <td style="width: 10">

                                            </td>
                                            <td style="width: 110;text-align: justify;margin-left:4em">
                                                <p> HAB <?php echo $mos_res1[$i]['nombre'] ?> </p>
                                            </td>
                                        </tr>
                                    </table></th>
                                    <th><p style="margin-left:1em"><?php echo $dif_dias ?></p></th>
                                    <th><p style=""><?php echo $mos_res1[$i]['precio'] ?></p></th>
                                    <th><p style="margin-left:1em"><?php echo Yii::$app->formatter->asDecimal($dif_dias * $mos_res1[$i]['precio'], 2) ?></p></th>
                                    </tr>
                                    <?php
                                }

                                $hab = $mos_hab1[$i]['id'];
                                $command = $connection->createCommand('select servicio.id,servicio.nombre,servicio.prioridad FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.nombre ORDER BY servicio.prioridad asc');
                                $command->bindParam(':reserva', $id_res);
                                $command->bindParam(':hab', $hab);
                                $servicios = $command->queryAll();

                                //print_r($servicios[0]['nombre']);die;

                                for ($k = 0; $k < count($servicios); $k++) {
                                    ?>
                                    <tr>
                                        <th width="120px" style="text-align: justify;margin-left: 3em"><b><?php echo $servicios[$k]['nombre'] ?></b></th>                                        
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $command = $connection->createCommand('select subservicios.nombre as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.nombre');
                                    $command->bindParam(':reserva', $id_res);
                                    $command->bindParam(':hab', $hab);
                                    $command->bindParam(':serv', $servicios[$k]['id']);
                                    $subservicios = $command->queryAll();

                                    for ($m = 0; $m < count($subservicios); $m++) {
                                        $total+=$subservicios[$m]['total'];
                                        ?>
                                        <tr>
                                            <th>
                                        <table  style="width: 120">
                                            <tr>
                                                <td style="width: 10">

                                                </td>
                                                <td style="width: 110;text-align: justify;margin-left: 4em">
                                                    <p> <?php echo $subservicios[$m]['nombre'] ?> </p>
                                                </td>
                                            </tr>
                                        </table></th>
                                        <th><p style="margin-left:1em"><?php echo $subservicios[$m]['cant'] ?></p></th>
                                        <th><p style=""><?php echo $subservicios[$m]['precio'] ?></p></th>
                                        <th><p style="margin-left:1em"><?php echo Yii::$app->formatter->asDecimal($subservicios[$m]['total'], 2) ?></p></th>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <th></th>
                                    <th><b style="margin-left:1em;text-decoration: underline;">TOTAL </b></th>
                                    <th><b style="margin-left:1em;text-decoration: underline;">(CUC)</b></th>
                                    <th><b style="margin-left:1em;text-decoration: underline;"><?php echo Yii::$app->formatter->asDecimal($total, 2) ?></b></th>
                                </tr>
                            </table>
                            <p style="margin-left:1.5em"><b style='font-size: 12px'>"El servicio esta incluido, mas, aceptamos propina"</b></p>
                            <p style="margin-left:5em;"><b>"GRACIAS POR VISITARNOS"</b></p>
                            <p></p>
                        </div>
                    </div>
                <?php }
                ?>




            </div>





            <div class="row hidden">
                <?php
//                $mos_res = ReservacionHab::find()->where(['reservacion' => $model->id])->andWhere(['estado' => 0])->orderBy('hab ASC')->all();
//                $mos_hab = [];
//                for ($i = 0; $i < count($mos_res); $i++) {
//                    if ($mos_res[$i]->hab0->nombre != 'ANEXO') {
//                        $mos_hab[count($mos_hab)] = $mos_res[$i];
//                    }
//                }
//
//                $id_res = $model->id;
//                $command = $connection->createCommand('select habitacion.id,habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
//                $command->bindParam(':reserva', $id_res);
//                $mos_res = $command->queryAll();
//                $connection->close();
//print_r($mos_hab);die;



                for ($i = 0; $i < count($mos_hab1); $i++) {
                    $total = 0;
                    ?>

                    <div class="col-md-4">
                        <div id="<?= $mos_hab1[$i]['id'] . '_ingles' ?>" class="Imprime" style="width: 230px;">


                            -----------------------------------------------------------------------------
                            <div style="margin-left:7em"><b>  HACIENDA "LA CASONA" </b></div>                       -----------------------------------------------------------------------------<br>
                            <p style="margin-left: 0.5em">  Client: <?php echo $model->nombre_cliente ?>  <br>
                                Check-In: <?php echo $fecha_ent ?><br>
                                Check-Out: <?php echo $fecha_sal ?><br>
                                Room(s): <?php echo $mos_hab1[$i]['nombre'] ?><br><br></p>
                            <table border='0'>
                                <tr>
                                    <th width="130px" style="text-align:justify;text-decoration: underline;">SERVICE</th>
                                    <th width="30px" style="text-decoration: underline;">QUANTITY</th>
                                    <th width="25px" style="margin-left: 0.5em;text-decoration: underline;">PRICE</th>
                                    <th width="45px" style="text-decoration: underline;">AMOUNT</th>
                                </tr>
                                <?php
                                if (count($mos_res) != 0) {

                                    $start_ts = strtotime($mos_res1[$i]['fecha_entrada']);
                                    $end_ts = strtotime($mos_res1[$i]['fecha_salida']);
                                    $diferencia = $end_ts - $start_ts;
                                    $dif_dias = round($diferencia / 86400);

                                    $total = $dif_dias * $mos_res1[$i]['precio'];
                                    ?>
                                    <tr>
                                        <th width="120px" style="text-align: justify;margin-left: 3em"><b>LODGING</b></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th >
                                    <table  style="width: 120;text-align: justify">
                                        <tr>
                                            <td style="width: 10">

                                            </td>
                                            <td style="width: 110;text-align: justify;margin-left:4em">
                                                <p> ROOM <?php echo $mos_res1[$i]['nombre'] ?> </p>
                                            </td>
                                        </tr>
                                    </table></th>
                                    <th><p style="margin-left:1em"><?php echo $dif_dias ?></p></th>
                                    <th><p style=""><?php echo $mos_res1[$i]['precio'] ?></p></th>
                                    <th><p style="margin-left:1em"><?php echo Yii::$app->formatter->asDecimal($dif_dias * $mos_res1[$i]['precio'], 2) ?></p></th>
                                    </tr>
                                    <?php
                                }

                                $hab = $mos_hab1[$i]['id'];
                                $command = $connection->createCommand('select servicio.id,servicio.ingles,servicio.prioridad FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado <> 1 GROUP BY servicio.nombre ORDER BY servicio.prioridad asc');
                                $command->bindParam(':reserva', $id_res);
                                $command->bindParam(':hab', $hab);
                                $servicios = $command->queryAll();

                                //print_r($servicios[0]['nombre']);die;

                                for ($k = 0; $k < count($servicios); $k++) {
                                    ?>
                                    <tr>
                                        <th width="120px" style="text-align: justify;margin-left: 3em"><b><?php echo $servicios[$k]['ingles'] ?></b></th>                                        
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $command = $connection->createCommand('select subservicios.ingles as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.nombre');
                                    $command->bindParam(':reserva', $id_res);
                                    $command->bindParam(':hab', $hab);
                                    $command->bindParam(':serv', $servicios[$k]['id']);
                                    $subservicios = $command->queryAll();

                                    for ($m = 0; $m < count($subservicios); $m++) {
                                        $total+=$subservicios[$m]['total'];
                                        ?>
                                        <tr>
                                            <th>
                                        <table  style="width: 120">
                                            <tr>
                                                <td style="width: 10">

                                                </td>
                                                <td style="width: 110;text-align: justify;margin-left: 4em">
                                                    <p> <?php echo $subservicios[$m]['nombre'] ?> </p>
                                                </td>
                                            </tr>
                                        </table></th>
                                        <th><p style="margin-left:1em"><?php echo $subservicios[$m]['cant'] ?></p></th>
                                        <th><p style=""><?php echo $subservicios[$m]['precio'] ?></p></th>
                                        <th><p style="margin-left:1em"><?php echo Yii::$app->formatter->asDecimal($subservicios[$m]['total'], 2) ?></p></th>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <th></th>
                                    <th><b style="margin-left:1em;text-decoration: underline;">TOTAL AMOUNT</b></th>
                                    <th><b style="text-decoration: underline;">(CUC)</b></th>
                                    <th><b style="margin-left:1em;text-decoration: underline;"><?php echo Yii::$app->formatter->asDecimal($total, 2) ?></b></th>
                                </tr>
                            </table>
                            <p style="margin-left:3.5em"><b style="font-size: 12px; margin-left:2em">"Service is included but we accept tips"</b></p>
                            <p style="margin-left:7em"><b>"THANKS FOR VISITING US"</b></p>

                        </div>
                    </div>
                <?php }
                ?>




            </div>




            <div class="row hidden">
                <?php
//                $mos_res = ReservacionHab::find()->where(['reservacion' => $model->id])->andWhere(['estado' => 0])->orderBy('hab ASC')->all();
//                $mos_hab = [];
//                for ($i = 0; $i < count($mos_res); $i++) {
//                    if ($mos_res[$i]->hab0->nombre != 'ANEXO') {
//                        $mos_hab[count($mos_hab)] = $mos_res[$i];
//                    }
//                }
//
//                $id_res = $model->id;
//                $command = $connection->createCommand('select habitacion.id,habitacion.nombre,reservacion_hab.precio,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida from reservacion,habitacion,reservacion_hab,agencia where reservacion_hab.hab=habitacion.id AND  reservacion_hab.reservacion=reservacion.id and  reservacion_hab.reservacion=:reserva and reservacion.agencia=agencia.id and agencia.pago=1 GROUP BY habitacion.nombre,reservacion_hab.fecha_entrada,reservacion_hab.fecha_salida');
//                $command->bindParam(':reserva', $id_res);
//                $mos_res = $command->queryAll();
//                $connection->close();MERCI DE NOUS VISITER
//print_r($mos_hab);die;



                for ($i = 0; $i < count($mos_hab1); $i++) {
                    $total = 0;
                    ?>

                    <div class="col-md-4">
                        <div id="<?= $mos_hab1[$i]['id'] . '_frances' ?>" class="Imprime" style="width: 230px;">


                            -----------------------------------------------------------------------------
                            <div style="margin-left:7em"><b>  HACIENDA "LA CASONA" </b></div>                       -----------------------------------------------------------------------------<br>
                            <p style="margin-left: 0.5em">Cliente: <?php echo $model->nombre_cliente ?>  <br>
                                Fecha Entrada: <?php echo $fecha_ent ?><br>
                                Fecha Salida: <?php echo $fecha_sal ?><br>
                                Chambre(s): <?php echo $mos_hab1[$i]['nombre'] ?><br><br></p>
                            <table border='0'>
                                <tr>

                                    <th width="120px" style="text-align: justify;text-decoration: underline;">SERVICE</th>
                                    <th width="30px" style="text-decoration: underline;">QUANTITÉ</th>
                                    <th width="30px" style="margin-left: 0.5em;text-decoration: underline;">PRIX</th>
                                    <th width="50px" style="text-decoration: underline;">MONTANT</th>

                                </tr>
                                <?php
                                if (count($mos_res) != 0) {
                                    $start_ts = strtotime($mos_res1[$i]['fecha_entrada']);
                                    $end_ts = strtotime($mos_res1[$i]['fecha_salida']);
                                    $diferencia = $end_ts - $start_ts;
                                    $dif_dias = round($diferencia / 86400);

                                    $total = $dif_dias * $mos_res1[$i]['precio'];
                                    ?>
                                    <tr>
                                        <th style="width: 110;text-align: justify;margin-left: 1em"><b>LOGEMENT</b></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th >

                                    <table  style="width: 120">
                                        <tr>
                                            <td style="width: 10">

                                            </td>
                                            <td style="width: 110;text-align: justify">
                                                <p> CHAMBRE <?php echo $mos_res1[$i]['nombre'] ?> </p>
                                            </td>
                                        </tr>
                                    </table></th>
                                    <th><p style="margin-left:1em"><?php echo $dif_dias ?></p></th>
                                    <th><p style=""><?php echo $mos_res1[$i]['precio'] ?></p></th>
                                    <th><p style="margin-left:1em"><?php echo Yii::$app->formatter->asDecimal($dif_dias * $mos_res1[$i]['precio'], 2) ?></p></th>
                                    </tr>
                                    <?php
                                }

                                $hab = $mos_hab1[$i]['id'];
                                $command = $connection->createCommand('select servicio.id,servicio.frances,servicio.prioridad FROM servicio,subservicios,reservacion_servicios where servicio.id=subservicios.servicio and subservicios.id=reservacion_servicios.servicio and  reservacion_servicios.hab=:hab and reservacion_servicios.reservacion=:reserva and reservacion_servicios.estado=0 GROUP BY servicio.nombre ORDER BY servicio.prioridad asc');
                                $command->bindParam(':reserva', $id_res);
                                $command->bindParam(':hab', $hab);
                                $servicios = $command->queryAll();

                                //print_r($servicios[0]['nombre']);die;

                                for ($k = 0; $k < count($servicios); $k++) {
                                    ?>
                                    <tr>
                                        <th style="width: 110;text-align: justify;margin-left: 1em"><b><?php echo $servicios[$k]['frances'] ?></b></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $command = $connection->createCommand('select subservicios.frances as nombre, SUM(reservacion_servicios.cant)as cant,reservacion_servicios.precio,SUM(reservacion_servicios.cant)*reservacion_servicios.precio as total  from subservicios,reservacion_servicios,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=reservacion_servicios.servicio and reservacion_servicios.reservacion=:reserva and reservacion_servicios.hab=:hab  and reservacion_servicios.estado <> 1 GROUP BY reservacion_servicios.servicio,reservacion_servicios.precio ORDER BY subservicios.nombre');
                                    $command->bindParam(':reserva', $id_res);
                                    $command->bindParam(':hab', $hab);
                                    $command->bindParam(':serv', $servicios[$k]['id']);
                                    $subservicios = $command->queryAll();

                                    for ($m = 0; $m < count($subservicios); $m++) {
                                        $total+=$subservicios[$m]['total'];
                                        ?>
                                        <tr>
                                            <th>
                                        <table  style="width: 120;text-align: justify">
                                            <tr>
                                                <td style="width: 5">

                                                </td>
                                                <td style="width: 115;text-align: justify;margin-left: 0.5em">
                                                    <p> <?php echo $subservicios[$m]['nombre'] ?> </p>
                                                </td>
                                            </tr>
                                        </table></th>
                                        <th><p style="margin-left:1em"><?php echo $subservicios[$m]['cant'] ?></p></th>
                                        <th><p style=""><?php echo $subservicios[$m]['precio'] ?></p></th>
                                        <th><p style="margin-left:1em"><?php echo Yii::$app->formatter->asDecimal($subservicios[$m]['total'], 2) ?></p></th>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <th></th>
                                    <th><b style="margin-left:1em;text-decoration: underline;">MONTANT TOTAL</b></th>
                                    <th><b style="text-decoration: underline;">(CUC)</b></th>
                                    <th><b style="margin-left:1em;text-decoration: underline;"><?php echo Yii::$app->formatter->asDecimal($total, 2) ?></b></th>
                                </tr>
                            </table>
                            <p style="margin-left:3.7em"><b style='font-size: 12px'>"Service inclus, mais acceptons pourboire"</b></p>
                            <p style="margin-left:6em"><b>"MERCI DE VOTRE VISITE"</b></p>
                            <p></p>
                        </div>
                    </div>
                <?php }
                ?>

            </div>



