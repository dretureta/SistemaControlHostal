
<?php

use frontend\models\Subservicios;
use frontend\models\Servicio;

//$subservicios = Subservicios::find()->all();
$serv = Servicio::find()->where([ 'estado' => 0])->all();

$this->title = 'REPORTES DE INGRESOS';
$this->params['breadcrumbs'][] = ['label' => 'REPORTES', 'url' => ['ingresos']];
$this->params['breadcrumbs'][] = $this->title;
?>

<br>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title">BUSCAR INGRESOS </h6>
    </div>
    <div class="panel-body">
        <form method="post" id="repagencia_validar" action="<?= \Yii::$app->urlManager->createUrl(['reportes/infoingresos']); ?>">
            <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
            <div class="row">






                <div class="col-md-2">
                    <b>Fecha Inicial</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input type="text" id="ing_entrada" class="form-control" name="ing_entrada" placeholder="Fecha Inicial" value="" required="required">
                        </div>
                    </div>
                </div>




                <div class="col-md-2">
                    <b>Fecha Final</b>


                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input data-toggle="cardloading" data-loading-effect="pulse" data-loading-color="amber" type="text" id="ing_salida" class="form-control" name="ing_salida" placeholder="Fecha Final" disabled="true" value="" required="required">
                        </div>
                    </div>

                </div>


                <div class="col-md-3">
                    <b>Servicios</b>
                    <div class="form-group form-float input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">settings</i>
                        </span>
                        <div class="form-line">
                            <select id="rep_servicios" class="form-control" name="rep_servicios"  aria-required="true">
                                <option value="">Seleccione Servicio</option>
                                <option value="0">ALOJAMIENTO</option>
                                <?php for ($i = 0; $i < count($serv); $i++) { ?>
                                    <option value="<?php echo $serv[$i]->id ?>"><?php echo $serv[$i]->nombre ?></option> 
                                <?php }
                                ?>
                            </select>                                                  
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <b>Subservicio</b>
                    <div class="form-group form-float input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">settings</i>
                        </span>
                        <div class="form-line" id="add_rep_subservicios">
                            <input type="text" id="rep_subservicios" disabled="true" class="form-control" value="Elija subservicio">

                        </div>
                    </div>
                </div>

                <div class="col-md-2">  


                    <button class="btn-success" style= 'height:33px;width: 100%'><i class="fa fa-search">  </i> Buscar</button>  


                </div>
            </div>
        </form>

        <form method="post" id="exportarexcel" action="<?= \Yii::$app->urlManager->createUrl(['reportes/ingresos-excel']); ?>">
            <input type="hidden" name="_csrf" value="WUlQWFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">

            <input type="hidden" id="mesexcel" name="entrada" value="<?= $entrada ?>">

            <input type="hidden" id="agenciaexcel" name="salida" value="<?= $salida ?>">

            <input type="hidden" id="agenciaexcel" name="servicio" value="<?= $servicios ?>">

            <input type="hidden" id="agenciaexcel" name="subservicio" value="<?= $subservicios ?>">


            <button class="btn-primary" style= 'height:33px;width: 100%'><i class="fa fa-print">  </i> Exportar a Excel</button>
        </form>
    </div>
</div>

<?php
if ($entrada != "") {
    $ent = explode("-", $entrada);
    $entrada = $ent[2] . "-" . $ent[1] . "-" . $ent[0];

    $sal = explode("-", $salida);
    $salida = $sal[2] . "-" . $sal[1] . "-" . $sal[0];
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-dollar"></i>  REPORTE DE INGRESOS RESERVACIONES DE <?php echo "<b>" . $entrada . "</b>" ?> HASTA <?php echo "<b>" . $salida . "</b>" ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->

                <table  class="table table-striped table-bordered" id="reportes_ingreso">

                    <thead class="bg-primary">
                        <tr>                              
                            <th class="text-center">Nombre Servicio</th>
                            <th class="text-center">Agencia</th>
                            <th class="text-center">Fecha Entrada</th>
                            <th class="text-center">Noches</th>
                            <th class="text-center">Cantidad / Hab</th>
                            <th class="text-center"> Importe Alojamiento</th>
                            <th class="text-center">Importe Servicios</th>  
                            <th class="text-center">Importe Total</th>                                                      
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $model = array();
                        if (isset($resultado)) {
                            $model = $resultado;
                        }
//                        print_r($enviar);
//                        die;

                        $suma_aloj = 0;
                        $suma_ser = 0;
                        $suma_total = 0;
                        for ($i = 0; $i < count($model); $i++) {

                            $suma_aloj = $suma_aloj + $model[$i]['imp_aloj'];
                            $suma_ser = $suma_ser + $model[$i]['imp_ser'];
                            $suma_total = $suma_total + $model[$i]['imp_ser'] + $model[$i]['imp_aloj'];
                            ?>

                            <tr >


                                <th class="text-center" ><?php echo $model[$i]['nombre'] ?></th>
                                <th class="text-center" ><?php echo $model[$i]['agencia'] ?></th>
                                <th class="text-center" ><?php echo $model[$i]['fecha'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['noches'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['canthab'] ?></th>                          
                                <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($model[$i]['imp_aloj'], 2) ?></th>
                                <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($model[$i]['imp_ser'], 2) ?></th>
                                <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($model[$i]['imp_ser'] + $model[$i]['imp_aloj'], 2) ?></th>

                            </tr>
                            <?php
                        }
                        ?>

                        <tr>
                            <th class="text-center" ><?php ?></th>
                            <th class="text-center" ><?php ?></th>
                            <th class="text-center" ><?php ?></th>
                            <th class="text-center"><?php ?></th>
                            <th class="text-center"><?php ?></th>                          
                            <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($suma_aloj, 2) ?></th>
                            <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($suma_ser, 2) ?></th>
                            <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($suma_total, 2) ?></th>

                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>



<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-dollar"></i>  REPORTE DE INGRESOS PASADIA DE <?php echo "<b>" . $entrada . "</b>" ?> HASTA <?php echo "<b>" . $salida . "</b>" ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->

                <table  class="table table-striped table-bordered" id="reportes_ingresopasa">

                    <thead class="bg-primary">
                        <tr>                              
                            <th class="text-center">Nombre Servicio</th>
                            <th class="text-center">Agencia</th>
                            <th class="text-center">Fecha Entrada</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Importe Total</th>                                                      
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $model = array();
                        if (isset($pasadia)) {
                            $model = $pasadia;
                        }
//                        print_r($enviar);
//                        die;
                        $suma_total = 0;
                        for ($i = 0; $i < count($model); $i++) {
                            $suma_total = $suma_total + $model[$i]['imp_ser'];
                            ?>

                            <tr>


                                <th class="text-center" ><?php echo $model[$i]['nombre'] ?></th>
                                <th class="text-center" ><?php echo $model[$i]['agencia'] ?></th>
                                <th class="text-center" ><?php echo $model[$i]['fecha'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['canthab'] ?></th> 
                                <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($model[$i]['imp_ser'], 2) ?></th>

                            </tr>
                            <?php
                        }
                        ?>
                        <tr>


                            <th class="text-center" ><?php ?></th>
                            <th class="text-center" ><?php ?></th>
                            <th class="text-center"><?php ?></th>
                            <th class="text-center"><?php ?></th> 
                            <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($suma_total, 2) ?></th>

                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

