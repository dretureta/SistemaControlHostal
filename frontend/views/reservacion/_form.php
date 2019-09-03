<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Habitacion;
use frontend\models\Agencia;
use frontend\models\ReservacionHab;
use frontend\models\Plan;

//use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */
/* @var $reshab frontend\models\ReservacionHab */
/* @var $form yii\widgets\ActiveForm */





$habitaciones = Habitacion::find()
//        ->innerJoin('ocupacion_hab', $on = 'habitacion.id=ocupacion_hab.hab')
        ->orderBy("id ASC")
        ->all();
$reshab = new ReservacionHab();


$fecha_ent = '';
$fecha_sal = '';
$nombre = '';
$agencia = '';
$obs = '';
$cod = '';
if (!is_null($aux)) {
    $nombre = $aux->nombre;
    $fe_en = explode('-', $aux->fecha_entrada);
    $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

    $fe_sa = explode('-', $aux->fecha_salida);
    $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

    $agencia = $aux->agencia0->nombre;
    $obs = $aux->obs;
    $cod = $aux->codigo;
}
if ($model->nombre_cliente != "") {
    $fecha_ent = $model->fecha_entrada;
}
?>


<?php if ($model->nombre_cliente != "") { ?>
    <input type="text" value="<?php echo $model->id ?>" id="id_reservacion" class="hidden">
    
<?php }
?>

<div class="reservacion-form">

    <div id="respond">



        <?php $form = ActiveForm::begin(); ?>

        <input type="text" name="id_reservacion" value="" class="hidden" id="act_reser">
        <div class="demo-masked-input">
            <div class="row clearfix">

                <div class="col-md-4" style="margin-top: 1em">
                    <b>Nombre</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-line">
                            <input required="required" type="text" id="reservacion-nombre_cliente" class="form-control" name="Reservacion[nombre_cliente]" placeholder="Nombre" maxlength="255" value="<?php echo $model->nombre_cliente . ' ' . $nombre ?>" >
                        </div>
                    </div>
                </div>

                <div class="col-md-4" style="margin-top: 1em">
                    <b>Fecha de Entrada</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input required="required" class="form-control" type="text" id="reservacion-fecha_entrada" name="Reservacion[fecha_entrada]" placeholder="Fecha Entrada" value="<?php echo $fecha_ent ?>">

                        </div>
                    </div>
                </div>

                <div class="col-md-4" style="margin-top: 1em">
                    <b>Fecha de Salida</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">   
                            <input required="required" type="text" id="reservacion-fecha_salida" name="Reservacion[fecha_salida]" placeholder="Fecha Salida" value="" class="form-control" disabled="true">


                        </div>
                    </div>
                </div>







                <div class="col-md-12">
                    <?php
                    $cont = 0;
                    for ($i = 0; $i < count($habitaciones); $i++) {
                        ?>
                        <div id="<?= $habitaciones[$i]->id ?>card_habitacion" class="col-md-4 hidden">
                            <div class="card">
                                <div class="header bg-blue-grey" style="height: 50px">
                                    <div class="row" style="margin-top: -0.6em">
                                        <div class="col-md-7">
                                            <h2 >
                                                <?= $habitaciones[$i]->nombre ?>
                                            </h2>
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <div class="switch">
                                                <label><input value="<?php echo $habitaciones[$i]->id ?>" data-hab="<?= $habitaciones[$i]->id . "habres" ?>" name="<?= $habitaciones[$i]->id ?>" id="<?= $habitaciones[$i]->id . "habres" ?>" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div id="<?php echo $habitaciones[$i]->id . "body" ?>" class="body">
                                    <div id="<?= $habitaciones[$i]->id ?>select_ocup_output">
                                        <input id="body" disabled="true" class="form-control" value="Ocupación">
                                    </div>
                                    <br>
                                    <div>
                                        <input type="text" id="<?= $habitaciones[$i]->id . "ocupacionprecio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $habitaciones[$i]->id . "ocupacionprecio" ?>">

                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php
                    }
                    ?>
                </div>

                <div class="col-md-12 hidden" id="vinculos">                    
                    <div class="col-md-10">
                        <br>
                        <b> <h4 style="color:red">NO HAY HABITACIONES DISPONIBLES PARA TODO EL PERIODO, SELECCIONE POR FECHA   <i class="fa fa-arrow-circle-right"></i> </h4> </b>
                        <br><br>
                    </div>
                    <div class="col-md-2" id="hiper" style="font-size: 14px">

                    </div>
                </div>



                <div class="col-md-4">
                    <b>Agencias</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">next_week</i>
                        </span>
                        <div class="form-line">
                            <select required="required" id="reservacion-agencia" name="Reservacion[agencia]" class="form-control show-tick" data-live-search="true" >
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
                            <select id="reservacion-plan" name="Reservacion[plan]" class="form-control show-tick" data-live-search="true">
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
                            <input type="text" id="reservacion-codigo" class="form-control" name="Reservacion[codigo]" placeholder="Codigo" maxlength="255" value="<?php echo $model->codigo . ' ' . $cod ?>">
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <b>Observaciones</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">comment</i>
                        </span>
                        <div class="form-line">
                            <textarea id="obs" rows="2" name="Reservacion[obs]" class="form-control no-resize" placeholder="Observaciones" value="<?php echo $model->obs . ' ' . $obs ?>"></textarea>
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



                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn-success" style= 'height:32px;width:94%' id="bus_act"><i class="fa fa-plus">  </i> ADICIONAR</button>
                    </div>
                </div>

                <div class="col-md-2" style="margin-top: 1em">

                    <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/index','tab' => 1]); ?>"  class="btn btn-danger text-center" style="height: 35px;width: 80%" id="id_tabprevia"><i class="fa fa-arrow-circle-left" >  </i><b> TERMINAR</b></a>
                </div>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>


    