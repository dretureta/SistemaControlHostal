<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Habitacion;
use frontend\models\Agencia;
use frontend\models\ReservacionHab;
use frontend\models\Plan;

$this->title = 'CREAR RESERVACIÓN';
$this->params['breadcrumbs'][] = ['label' => 'RESERVACIÓN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */
/* @var $reshab frontend\models\ReservacionHab */
/* @var $form yii\widgets\ActiveForm */

$fecha = explode('-', $entrada);
$fecha_sal = explode('-', $salida);




if ($reservacion != '') {

    $hab_ocupadas = ReservacionHab::find()->where(['reservacion' => $reservacion])->andWhere(['estado' => 0])->all();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?= Html::encode($this->title) . ' ' . $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0] ?></h3>
        </div>
        <div class="panel-body">
            <div class="agencia-create">


                <div id="respond">



                    <?php
                    $form = ActiveForm::begin([
                                'method' => 'post',
                                'action' => ['reservacion/actpers'],]);
                    ?>

                    <input required="required" type="text" id="" class="hidden" name="id_reservacion" placeholder="Nombre" maxlength="255" value="<?php echo $hab_ocupadas[0]->reservacion ?>" >


                    <div class="row">
                        <div class="col-md-8" style="margin-top: 1em">
                            <b>Nombre</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">face</i>
                                </span>
                                <div class="form-line">
                                    <input required="required" type="text" id="reservacion-nombre_cliente" class="form-control" name="nom_reservacion" placeholder="Nombre" maxlength="255" value="<?php echo $hab_ocupadas[0]->reservacion0->nombre_cliente ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 hidden" style="margin-top: 1em">
                            <b>Fecha de Entrada</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input required="required" class="form-control" type="text" id="reservacion-fecha_entrada" name="entcambiar" placeholder="Fecha Entrada" value="<?php echo $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0] ?>" >

                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 hidden" style="margin-top: 1em">
                            <b>Fecha de Salida</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">   
                                    <input required="required" type="text" id="reservacion-fecha_salida" name="salcambiar" placeholder="Fecha Salida" value="<?php echo $fecha_sal[2] . '-' . $fecha_sal[1] . '-' . $fecha_sal[0] ?>" class="form-control" >


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="demo-masked-input">










                        <div class="row">
                            <?php
                            // print_r($model);die;

                            for ($i = 0; $i < count($hab_ocupadas); $i++) {
                                $fe_mos = explode('-', $hab_ocupadas[$i]->fecha_entrada);
                                $fe_mos1 = $fe_mos[2] . '-' . $fe_mos[1] . '-' . $fe_mos[0];
                                ?>
                                <div class="col-md-4 ">
                                    <div class="card">
                                        <div class="header bg-blue-grey">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <h2>
                                                        <?= $hab_ocupadas[$i]->hab0->nombre . ' <b>' . $fe_mos1 . '</b>' ?>
                                                    </h2>
                                                </div>
                                                <div class="col-md-5 text-right">
                                                    <div class="switch">
                                                        <label><input disabled="true" value="<?php echo $hab_ocupadas[$i]->hab ?>"  name="<?= $hab_ocupadas[$i]->hab ?>" data-act="<?= $hab_ocupadas[$i]->hab ?>" id="<?= $hab_ocupadas[$i]->hab . 'act' ?>"  type="checkbox" checked="true"><span class="lever switch-col-indigo"></span></label>
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
                            
                            if (count($model) != 0) {


                                for ($i = 0; $i < count($model); $i++) {
                                    ?>
                                    <div id="<?= $model[$i]['id'] ?>card_habitacion" class="col-md-4 ">
                                        <div class="card">
                                            <div class="header bg-blue-grey">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <h2>
                                                            <?= $model[$i]['nombre'] ?>
                                                        </h2>
                                                    </div>
                                                    <div class="col-md-5 text-right">
                                                        <div class="switch">
                                                            <label><input value="<?php echo $model[$i]['id'] ?>" data-hab="<?= $model[$i]['id'] . "habres" ?>" name="<?= $model[$i]['id'] ?>" id="<?= $model[$i]['id'] . "habres" ?>" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div id="<?php echo $model[$i]['id'] . "body" ?>" class="body">
                                                <div id="<?= $model[$i]['id'] ?>select_ocup_output">
                                                    <input id="body" disabled="true" class="form-control" value="Ocupación">
                                                </div>
                                                <br>
                                                <div>
                                                    <input type="text" id="<?= $model[$i]['id'] . "ocupacionprecio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $model[$i]['id'] . "ocupacionprecio" ?>">

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-md-6 " id="vinculos">
                                    <div class="row">

                                        <div class="col-md-9">
                                            <br><br>
                                            <b> <h4 style="color:red">NO HAY HABITACIONES DISPONIBLES PARA TODO EL PERIODO, SELECCIONE POR FECHA   <i class="fa fa-arrow-circle-right"></i> </h4> </b>

                                        </div>
                                        <div class="col-md-3" id="hiper">
                                            <?php
                                            $start_ts = strtotime($inicial);
                                            $end_ts = strtotime($final);
                                            $diferencia = $end_ts - $start_ts;
                                            $dif_dias = round($diferencia / 86400) - 1;

                                            $rango = array();
                                            $rango[count($rango)] = $inicial;
                                            $inicial1 = $inicial;


                                            for ($i = 0; $i < $dif_dias; $i++) {
                                                $mod_date1 = strtotime($inicial1 . "+ 1 days");
                                                $inicial1 = date("d-m-Y", $mod_date1);
                                                $rango[count($rango)] = $inicial1;
                                            }

                                            if (count($rango) != 0) {
                                                for ($i = 0; $i < count($rango); $i++) {
                                                    ?>

                                                    <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/addfecha', 'fecha' => $rango[$i], 'res' => $reservacion, 'inicial' => $inicial, 'final' => $final, 'nombre' => $hab_ocupadas[0]->reservacion0->nombre_cliente]); ?>"><span class="glyphicon glyphicon-calendar"></span> &nbsp;<?php echo $rango[$i] ?></a><br>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>

                            <?php }
                            ?>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <b>Agencias</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">next_week</i>
                                    </span>
                                    <div class="form-line">
                                        <select required="required" id="reservacion-agencia" name="agencia_res" class="form-control show-tick" data-live-search="true" >
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
                                        <input type="text" id="reservacion-codigo" class="form-control" name="codigo_res" placeholder="Codigo" maxlength="255" value="">
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
                                        <textarea id="obs" rows="1" name="obs_res" class="form-control no-resize" placeholder="Observaciones" value=""></textarea>
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

                            <input type="text" name="inicial" value="<?php echo $inicial ?>" class="hidden">
                            <input type="text" name="final" value="<?php echo $final ?>" class="hidden">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn-success" style= 'height:32px;width:94%' id="bus_act"><i class="fa fa-plus">  </i> ADICIONAR</button>
                                </div>
                            </div>

                            <div class="col-md-2" style="margin-top: 1em">

                                <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/index', 'tab' => 1]); ?>" class="btn btn-danger text-center" style="height: 35px;width: 80%"><i class="fa fa-arrow-circle-left">  </i><b> TERMINAR</b></a>

                            </div>
                        </div>









                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } else {
    ?>




    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?= Html::encode($this->title) . ' ' . $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0] ?></h3>
        </div>
        <div class="panel-body">
            <div class="agencia-create">


                <div id="respond">



                    <?php
                    $form = ActiveForm::begin([
                                'method' => 'post',
                                'action' => ['reservacion/crear'],]);
                    ?>

                    <input type="text" name="id_reservacion" value="" class="hidden" id="act_reser">

                    <div class="demo-masked-input">
                        <div class="row clearfix">

                            <div class="col-md-8" style="margin-top: 1em">
                                <b>Nombre</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                    <div class="form-line">
                                        <input required="required" type="text" id="reservacion-nombre_cliente" class="form-control" name="Reservacion[nombre_cliente]" placeholder="Nombre" maxlength="255" value="<?php echo $nombre ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 hidden" style="margin-top: 1em">
                                <b>Fecha de Entrada</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input required="required" class="form-control" type="text" id="reservacion-fecha_entrada" name="fe_entrada" placeholder="Fecha Entrada" value="<?php echo $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0] ?>" >

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 hidden" style="margin-top: 1em">
                                <b>Fecha de Salida</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">   
                                        <input required="required" type="text" id="reservacion-fecha_salida" name="fe_salida" placeholder="Fecha Salida" value="<?php echo $fecha_sal[2] . '-' . $fecha_sal[1] . '-' . $fecha_sal[0] ?>" class="form-control" >


                                    </div>
                                </div>
                            </div>







                            <div class="col-md-12">
                                <?php
                                if (count($model) != 0) {


                                    for ($i = 0; $i < count($model); $i++) {
                                        ?>
                                        <div id="<?= $model[$i]['id'] ?>card_habitacion" class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                                            <div class="card">
                                                <div class="header bg-blue-grey">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <h2>
                                                                <?= $model[$i]['nombre'] ?>
                                                            </h2>
                                                        </div>
                                                        <div class="col-md-5 text-right">
                                                            <div class="switch">
                                                                <label><input value="<?php echo $model[$i]['id'] ?>" data-hab="<?= $model[$i]['id'] . "habres" ?>" name="<?= $model[$i]['id'] ?>" id="<?= $model[$i]['id'] . "habres" ?>" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div id="<?php echo $model[$i]['id'] . "body" ?>" class="body">
                                                    <div id="<?= $model[$i]['id'] ?>select_ocup_output">
                                                        <input id="body" disabled="true" class="form-control" value="Ocupación">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <input type="text" id="<?= $model[$i]['id'] . "ocupacionprecio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $model[$i]['id'] . "ocupacionprecio" ?>">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-md-6" id="vinculos">
                                        <div class="row">
                                            <div class="col-md-3" id="hiper">                                                

                                            </div>
                                            <div class="col-md-9">
                                                <br><br>
                                                <b> NO HAY HABITACIONES DISPONIBLES EN EL PERIODO DE FECHA SELECCIONADO </b>
                                                <br><br>
                                            </div>

                                        </div>
                                    </div>

                                <?php }
                                ?>
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
                                        <input type="text" id="reservacion-codigo" class="form-control" name="Reservacion[codigo]" placeholder="Codigo" maxlength="255" value="">
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
                                        <textarea id="obs" rows="1" name="Reservacion[obs]" class="form-control no-resize" placeholder="Observaciones" value=""></textarea>
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


                            <input type="text" name="inicial2" value="<?php echo $inicial ?>" class="hidden">
                            <input type="text" name="final2" value="<?php echo $final ?>" class="hidden">



                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn-success" style= 'height:32px;width:94%' id="bus_act"><i class="fa fa-plus">  </i> ADICIONAR</button>
                                </div>
                            </div>

                            <div class="col-md-2" style="margin-top: 1em">

                                <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/index', 'tab' => 1]); ?>" class="btn btn-danger text-center" style="height: 35px;width: 80%"><i class="fa fa-arrow-circle-left">  </i><b> TERMINAR</b></a>

                            </div>
                        </div>


                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php } ?>






