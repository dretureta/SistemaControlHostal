
<?php

use frontend\models\Subservicios;
use frontend\models\Servicio;
use frontend\models\Agencia;

$servicios = Servicio::find()->all();

$this->title = 'REPORTES DE GENERAL';
$this->params['breadcrumbs'][] = ['label' => 'REPORTES', 'url' => ['general']];
$this->params['breadcrumbs'][] = $this->title;
?>

<br>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title">BUSCAR GENERAL </h6>
    </div>
    <div class="panel-body">
        <form method="post" id="repagencia_validar" action="<?= \Yii::$app->urlManager->createUrl(['reportes/infogeneral']); ?>">
            <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">

            <div class="row">
                <div class="col-md-4">
                    <b>Fecha Inicial</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input type="text" id="general_entrada" class="form-control" name="general_entrada" placeholder="Fecha Inicial" value="" required="required">
                        </div>
                    </div>
                </div>




                <div class="col-md-4">
                    <b>Fecha Final</b>


                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input data-toggle="cardloading" data-loading-effect="pulse" data-loading-color="amber" type="text" id="general_salida" class="form-control" name="general_salida" placeholder="Fecha Final" disabled="true" value="" required="required">
                        </div>
                    </div>

                </div>


                <div class="col-md-4">
                    <b>Agencia</b>


                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">next_week</i>
                        </span>
                        <div class="form-line">
                            <select id="general_agencia" name="general_agencia" class="form-control show-tick" data-live-search="true" >
                                <?php $agen = Agencia::find()->orderBy("nombre asc")->all(); ?>
                                <option >Agencia</option>
                                <?php for ($i = 0; $i < count($agen); $i++) { ?>
                                    <option value="<?= $agen[$i]->id ?>"><?= $agen[$i]->nombre ?></option>
                                <?php } ?>


                            </select>



                        </div>
                    </div>

                </div>
            </div>
            
            <div class="row">


                <div class="col-md-3">
                    <b>Servicios</b>
                    <div class="form-group form-float input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">settings</i>
                        </span>
                        <div class="form-line">
                            <select id="general_servicios" class="form-control" name="general_servicios"  aria-required="true">
                                <option value="">Seleccione Servicio</option>
                                <option value="0">ALOJAMIENTO</option>
                                <?php for ($i = 0; $i < count($servicios); $i++) { ?>
                                    <option value="<?php echo $servicios[$i]->id ?>"><?php echo $servicios[$i]->nombre ?></option> 
                                <?php }
                                ?>
                            </select>                                                  
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <b>Subservicio</b>
                    <div class="form-group form-float input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">settings</i>
                        </span>
                        <div class="form-line" id="add_general_subservicios">
                            <input type="text" id="general_subservicios" disabled="true" class="form-control" value="Elija primero un servicio">

                        </div>
                    </div>
                </div>




                <div class="col-md-1" >
                    <b>Servicios Incluidos</b><br><br>
                    <div class="switch">
                        <label><input style="margin-top: -2em"value="1" name="incluir" id="incluir2" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                    </div>
                </div>

                <div class="col-md-2">  


                    <button class="btn-success" style= 'height:33px;width: 100%;margin-top: 2em'><i class="fa fa-search">  </i> Buscar</button>  


                </div>
            </div>
        </form>
        <div class="" > 

            <form method="post" id="exportarexcel" action="<?= \Yii::$app->urlManager->createUrl(['reportes/general-excel']); ?>">
                <input type="hidden" name="_csrf" value="WUlQWFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">

                <input class="hidden" type="" id="gen_entrada" name="gen_entrada" value="<?= $entrada ?>">

                <input class="hidden" type="" id="gen_salida" name="gen_salida" value="<?= $salida ?>">

                <input class="hidden" type="" id="gen_agencia" name="gen_agencia" value="<?= $agencia ?>">

                <input class="hidden" type="" id="gen_serv" name="gen_serv" value="<?= $servicio ?>">

                <input class="hidden" type="" id="gen_serv" name="gen_sub" value="<?= $subservicio ?>">

                <input class="hidden" type="" id="gen_incluir" name="gen_incluir" value="<?= $incluir ?>">

                <button class="btn-primary" style= 'height:33px;width: 100%'><i class="fa fa-print">  </i> Exportar a Excel</button>
            </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-dollar"></i>  REPORTE GENERAL
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->

                <table  class="table table-striped table-bordered" id="reportes_general">

                    <thead class="bg-primary">
                        <tr>                            
                            <th class="text-center">CLIENTE</th>
                            <th class="text-center">AGENCIA</th>
                            <th class="text-center">SERVICIO</th>
                            <th class="text-center">SUBSERVICIO</th>
                            <th class="text-center">CANT SUBSERV</th>
                            <th class="text-center">CANT HAB</th>
                            <th class="text-center">PRECIO</th>
                            <th class="text-center">NOCHES</th>
                            <th class="text-center">IMP ALOJAMIENTO</th>
                            <th class="text-center">IMP SERVICIO</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $model = array();
                        if (isset($result)) {
                            $model = $result;
                        }


//                        print_r($model);
//                        die;
                        for ($i = 0; $i < count($model); $i++) {
                            ?>

                            <tr >
                                <th class="text-center"><?php echo $model[$i]['cliente'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['agencia'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['servicio'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['subservicio'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['cantsubserv'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['canthab'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['precio'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['noches'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['imp_aloj'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['imp_serv'] ?></th>



                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

