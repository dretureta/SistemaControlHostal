<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */

$this->title = 'ACTUALIZAR RESERVACIÓN: ' . ' ' . $model->nombre_cliente;
$this->params['breadcrumbs'][] = ['label' => 'RESERVACIÓN', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'ACTUALIZAR';

use yii\widgets\ActiveForm;
use frontend\models\ReservacionHab;
use frontend\models\Habitacion;
use frontend\models\Agencia;
use frontend\models\Plan;

$hab_ocupadas = ReservacionHab::find()->where(['reservacion' => $model->id])->andWhere(['estado' => 0])->all();
$hab = Habitacion::find()->orderBy('id ASC')->all();





$hab_dis = array();
$cont = 0;

$fecha_ent = $model->fecha_entrada;
$fecha_sal = $model->fecha_salida;



$fe_en = explode('-', $fecha_ent);
$model->fecha_entrada = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

$fe_sa = explode('-', $fecha_sal);
$model->fecha_salida = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

$salida = $model->fecha_salida;
$entrada = $model->fecha_entrada;

//print_r($hab_ocupadas[1]);die;

for ($i = 0; $i < count($hab); $i++) {

    $id_hab = $hab[$i]->id;

//    $connection = \Yii::$app->db;
//    $connection->open();
//
//    $command = $connection->createCommand('SELECT reservacion.nombre_cliente FROM reservacion,reservacion_hab WHERE  (reservacion_hab.hab = :habitacion) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion.fecha_entrada <= :entrada1) AND (reservacion.fecha_salida > :salida1) AND (reservacion_hab.estado=0)  OR (reservacion.fecha_entrada <=:entrada2 ) AND (reservacion.fecha_salida >= :salida2) AND (reservacion.fecha_entrada > :entrada3 AND reservacion.fecha_entrada < :salida3) AND  (reservacion_hab.hab = :habitacion1)AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0) OR (reservacion.fecha_salida > :entrada4 AND reservacion.fecha_salida < :salida4) AND (reservacion_hab.hab = :habitacion2) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0)');
//    $command->bindParam(':habitacion', $id_hab);
//    $command->bindParam(':entrada1', $entrada);
//    $command->bindParam(':salida1', $entrada);
//    $command->bindParam(':entrada2', $salida);
//    $command->bindParam(':salida2', $salida);
//    $command->bindParam(':entrada3', $entrada);
//    $command->bindParam(':salida3', $salida);
//    $command->bindParam(':habitacion1', $id_hab);
//    $command->bindParam(':entrada4', $entrada);
//    $command->bindParam(':salida4', $salida);
//    $command->bindParam(':habitacion2', $id_hab);
//    $result = $command->queryAll();
//    $connection->close();
//    if (count($result) == 0) {
    $hab_dis[count($hab_dis)] = array(
        'id' => $hab[$i]->id,
        'nombre' => $hab[$i]->nombre
    );
//    }
}
?>


<?php if (count($data) != 0) { ?>

    <div class = "panel panel-default" >
        <div class = "panel-heading">
            <h3 class = "panel-title"> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <div class="agencia-create">






                <?php
                $form = ActiveForm::begin(['id' => 'form-signup',
                            'method' => 'post',
                            'action' => ['reservacion/actres'],]);
                ?> 

                <div class="pasadia-index">

                    <div class="row">

                        <input type="text" name="id_reservacion" value="<?php echo $model->id ?>" class="hidden" id="act_reser">

                        <div class="col-md-6">
                            <b>Nombre</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">face</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" id="reservacion-nombre_cliente" class="form-control" name="nom_reservacion" placeholder="Nombre" maxlength="255" value="<?php echo $model->nombre_cliente ?>" required="required">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <b>Fecha de Entrada</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" id="reservacion-fecha_entrada" class="form-control"  name="entcambiar" placeholder="Fecha Entrada" value="<?php echo $fecha_ent ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" >
                            <b>Fecha de Salida</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input data-toggle="cardloading" data-loading-effect="pulse" data-loading-color="amber" type="text" id="reservacion-fecha_salida" class="form-control" name="salcambiar" placeholder="Fecha Salida"  value="<?php echo $fecha_sal ?>" >
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">  

                        <div style="width: 100%;height: 420px;overflow-y: auto;">
                            <?php
                            for ($i = 0; $i < count($hab_ocupadas); $i++) {
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                                    <div class="card">
                                        <div class="header bg-blue-grey" style="height: 50px">
                                            <div class="row" style="margin-top: -0.6em">
                                                <div class="col-md-8">
                                                    <h2>
                                                        <?= $hab_ocupadas[$i]->hab0->nombre ?>
                                                    </h2>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <div class="switch">
                                                        <label><input value="<?php echo $hab_ocupadas[$i]->hab ?>"  name="<?= $hab_ocupadas[$i]->hab ?>" data-act="<?= $hab_ocupadas[$i]->hab ?>" id="<?= $hab_ocupadas[$i]->hab . 'act' ?>"  type="checkbox" checked="true" ><span class="lever switch-col-indigo"></span></label>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div id="<?php echo $hab_ocupadas[$i]->hab . "body" ?>" class="body">

                                            <div id="<?= $hab_ocupadas[$i]->hab ?>select_ocup_output">
                                                <input id="body" disabled="true" class="form-control" value="<?php echo $hab_ocupadas[$i]->ocupacion0->ocupacion0->nombre ?>" name="<?= $hab_ocupadas[$i]->id . 'ocupacionact' ?>">
                                            </div>

                                            <br>
                                            <div>
                                                <input type="text" id="<?= $hab_ocupadas[$i]->hab . "ocupacionactprecio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $hab_ocupadas[$i]->hab . "ocupacionprecio" ?>" value="<?= $hab_ocupadas[$i]->precio ?>">



                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>






                            <?php
                            for ($k = 0; $k < count($data); $k++) {
                                ?>
                                <div id="<?= $data[$k]['id_hab'] ?>card_habitacion" class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <div class="card">
                                        <div class="header bg-blue-grey" style="height: 50px">
                                            <div class="row" style="margin-top: -0.6em">
                                                <div class="col-md-7">
                                                    <h2>
                                                        <?= $data[$k]['nombre'] ?>
                                                    </h2>
                                                </div>
                                                <div class="col-md-5 text-right">
                                                    <div class="switch">
                                                        <label><input value="<?php echo $data[$k]['id_hab'] ?>" data-act="<?= $data[$k]['id_hab'] ?>" name="<?= $data[$k]['id_hab'] ?>" id="<?= $data[$k]['id_hab'] . 'act' ?>" type="checkbox" ><span class="lever switch-col-indigo"></span></label>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div id="<?php echo $data[$k]['id_hab'] . "body" ?>" class="body">
                                            <div id="<?= $data[$k]['id_hab'] ?>select_ocup_output">
                                                <input id="body" disabled="true" class="form-control" value="Ocupación">
                                            </div>
                                            <br>
                                            <div>
                                                <input type="text" id="<?= $data[$k]['id_hab'] . "ocupacionactprecio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $data[$k]['id_hab'] . "ocupacionprecio" ?>">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <b>Agencias</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">next_week</i>
                                </span>
                                <div class="form-line">
                                    <select id="reservacion-agencia" name="agencia_res" class="form-control show-tick" data-live-search="true" required="required">
                                        <?php $agen = Agencia::find()->orderBy('nombre asc')->all(); ?>
                                        <option >Agencia</option>
                                        <?php for ($i = 0; $i < count($agen); $i++) { ?>
                                            <option value="<?= $agen[$i]->id ?>"><?= $agen[$i]->nombre ?></option>
                                        <?php } ?>


                                    </select>



                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <b>Plan</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">next_week</i>
                                </span>
                                <div class="form-line">
                                    <select id="reservacion-plan" name="plan_res" class="form-control show-tick" data-live-search="true">
                                        <?php $agen = Plan::find()->all(); ?>                               
                                        <?php for ($i = 0; $i < count($agen); $i++) { ?>
                                            <option value="<?= $agen[$i]->id ?>"><?= $agen[$i]->nombre ?></option>
                                        <?php } ?>


                                    </select>



                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <b>Codigo</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">next_week</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" id="reservacion-codigo" class="form-control" name="codigo_res" placeholder="Codigo" maxlength="255" value="<?php echo $model->codigo ?>">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <b>Observaciones</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">comment</i>
                                </span>
                                <div class="form-line">
                                    <textarea id="obs" rows="2" name="obs_res" class="form-control no-resize" placeholder="Observaciones" value="<?php echo $model->obs ?>"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <b>Incluir Alojamiento</b>
                            <div class="col-md-4 text-right" style="margin-top: 1.5em">
                                <div class="switch">
                                    <label><input value="1" name="conjunto" id="conjunto" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                </div>
                            </div>

                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn-success" style= 'height:32px;' id="bus_act"><i class="fa fa-edit">  </i> ACTUALIZAR</button>
                            </div>
                        </div>

                        <div class="col-md-2" style="margin-top: 1em;margin-left: -5em">

                            <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/index', 'tab' => 1]); ?>" class="btn btn-danger text-center" style="height: 35px;width: 80%"><i class="fa fa-arrow-circle-left">    </i> <b>  TERMINAR</b></a>

                        </div>
                    </div>


                </div>
                <?php ActiveForm::end(); ?>


            </div>







        </div>
    </div>
<?php } else {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <div class="agencia-create">


                <div class="row">

                    <div class="col-md-10" id="vinculos">
                        <br>
                        <b> <h4 style="color:red">NO HAY HABITACIONES DISPONIBLES PARA TODO EL PERIODO, SELECCIONE POR FECHA   <i class="fa fa-arrow-circle-right"></i> </h4> </b>
                        <br><br>
                    </div>
                    <div class="col-md-2" id="hiper" style="font-size: 14px">

                        <?php
                        if (count($rango) != 0) {
                            for ($i = 0; $i < count($rango); $i++) {
                                ?>

                                <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/addfecha', 'fecha' => $rango[$i], 'res' => $model->id, 'inicial' => $inicial, 'final' => $final, 'nombre' => $model->nombre_cliente]); ?>"><span class="glyphicon glyphicon-calendar"></span> &nbsp;<?php echo $rango[$i]?></a><br>
                                <?php
                            }
                        }

                        //print_r($rango);
                        ?>
                    </div>
                </div>

                <div class="row">                    
                    <?php
                    for ($i = 0; $i < count($hab_ocupadas); $i++) {
                        ?>
                        <div class="col-lg-3 col-md-5 col-sm-7 col-xs-12 " >
                            <div class="card">
                                <div class="header bg-blue-grey" style="height: 50px">
                                    <div class="row" style="margin-top: -0.6em">
                                        <div class="col-md-8">
                                            <h2>
                                                <?= 'HAB ' . $hab_ocupadas[$i]->hab0->nombre ?>
                                            </h2>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <div class="switch">
                                                <label><input value="<?php echo $hab_ocupadas[$i]->hab ?>"  name="<?= $hab_ocupadas[$i]->hab ?>" data-act="<?= $hab_ocupadas[$i]->hab ?>" id="<?= $hab_ocupadas[$i]->hab . 'act' ?>"  type="checkbox" checked="true" ><span class="lever switch-col-indigo"></span></label>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div id="<?php echo $hab_ocupadas[$i]->hab . "body" ?>" class="body">

                                    <div id="<?= $hab_ocupadas[$i]->hab ?>select_ocup_output">
                                        <input id="body" disabled="true" class="form-control" value="<?php echo $hab_ocupadas[$i]->ocupacion0->ocupacion0->nombre ?>" name="<?= $hab_ocupadas[$i]->id . 'ocupacionact' ?>">
                                    </div>

                                    <br>
                                    <div>
                                        <input type="text" id="<?= $hab_ocupadas[$i]->hab . "ocupacionactprecio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $hab_ocupadas[$i]->hab . "ocupacionprecio" ?>" value="<?= $hab_ocupadas[$i]->precio ?>">



                                    </div>
                                </div>
                            </div>
                        </div>





                    <?php }
                    ?>


                </div>

            </div>
        </div>
    </div>

<?php }
?>
