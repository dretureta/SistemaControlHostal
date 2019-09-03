<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Agencia;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */
/* @var $reshab frontend\models\ReservacionHab */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'RESERVACIONES DENEGADAS';
$this->params['breadcrumbs'][] = ['label' => 'RESERVACIÓN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <div class="agencia-create">

            <?php
            $form = ActiveForm::begin([
                        'method' => 'post',
                        'id' => 'res_denegadas',
                        'action' => ['reservacion/addenegada']]);
            ?>


            <div class="demo-masked-input">
                <div class="row clearfix">

                    <div class="col-md-6">
                        <b>Nombre</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">
                                <input type="text" id="reservacion-nombre_cliente" class="form-control" name="res_denegada" placeholder="Nombre" maxlength="255" value="<?php echo $model->nombre_cliente ?>" required="required">
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
                                <input type="text" id="reservacion-fecha_entrada" class="form-control" required="required" name="fechaent_denegada" placeholder="Fecha Entrada" value="<?php echo $model->fecha_entrada ?>">
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
                                <input data-toggle="cardloading" data-loading-effect="pulse" data-loading-color="amber" required="required" type="text" id="reservacion-fecha_salida" class="form-control" name="fechasal_denegada" placeholder="Fecha Salida" disabled="true" value="<?php echo $model->fecha_salida ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-3">                        
                        <b>Simple</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">
                                <input type="text" id="simple" class="form-control" name="simple" placeholder="Simple"  maxlength="255" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">                        
                        <b>Doble</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">
                                <input type="text" id="doble" class="form-control" name="doble" placeholder="Doble"  maxlength="255">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 hidden" >
                        <b>Twins</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">
                                <input type="text" id="twins" class="form-control" name="twins"  placeholder="Twins" maxlength="255">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <b>Triple</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">
                                <input type="text" id="triple" class="form-control" name="triple"  placeholder="Triple" maxlength="255">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <b>Agencias</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">next_week</i>
                            </span>
                            <div class="form-line">
                                <select id="reservacion-agencia" name="agencia" required="required" class="form-control show-tick" data-live-search="true">
                                    <?php $agen = Agencia::find()->orderBy("nombre asc")->all(); ?>
                                    <option >Agencia</option>
                                    <?php for ($i = 0; $i < count($agen); $i++) { ?>
                                        <option value="<?= $agen[$i]->id ?>"><?= $agen[$i]->nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <b>Observaciones</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">comment</i>
                            </span>
                            <div class="form-line">
                                <textarea id="obs" rows="1" name="obs" class="form-control no-resize" placeholder="Observaciones" value="<?php echo $model->obs ?>"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn-success" style= 'height:32px;width: 94%' id="bus_act"><i class="fa fa-plus">  </i> ADICIONAR</button>
                        </div>
                    </div>

                    <div class="col-md-2" style="margin-top: 1em">

                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/index', 'tab' => 2]); ?>" class="btn btn-danger text-center" style="height: 35px;width: 100%"><i class="fa fa-arrow-circle-left">  </i><b> TERMINAR</b></a>

                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>