<?php
$this->title = 'REPORTES DE GASTOS';
$this->params['breadcrumbs'][] = ['label' => 'REPORTES', 'url' => ['gastos']];
$this->params['breadcrumbs'][] = $this->title;
?>


<br>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title">BUSCAR GASTOS </h6>
    </div>
    <div class="panel-body">
        <form method="post" id="repagencia_validar" action="<?= \Yii::$app->urlManager->createUrl(['reportes/infogastos']); ?>">
            <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
            <div class="row">






                <div class="col-md-3">
                    <b>Fecha Inicial</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input type="text" id="gastos_entrada" class="form-control" name="gastos_entrada" placeholder="Fecha Inicial" value="" required="required">
                        </div>
                    </div>
                </div>




                <div class="col-md-3">
                    <b>Fecha Final</b>


                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input data-toggle="cardloading" data-loading-effect="pulse" data-loading-color="amber" type="text" id="gastos_salida" class="form-control" name="gastos_salida" placeholder="Fecha Final" disabled="true" value="">
                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    <b>Gastos</b>


                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">next_week</i>
                        </span>
                        <div class="form-line">
                            <select id="gastos_rep" class="form-control" disabled="true" name="gastos">
                                <option value="">Seleccione Gastos</option>
                                <?php

                                use frontend\models\Gastos;

$gas = Gastos::find()->orderBy("nombre asc")->all();
                                for ($i = 0; $i < count($gas); $i++) {
                                    ?>
                                    <option value="<?php echo $gas[$i]->id ?>"><?php echo $gas[$i]->nombre ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="col-md-2">  


                    <button class="btn-success" style= 'height:33px;width: 100%'><i class="fa fa-search">  </i> Buscar</button>  


                </div>
            </div>
        </form>

        <form method="post" id="exportarexcel" action="<?= \Yii::$app->urlManager->createUrl(['reportes/gastos-excel']); ?>">
            <input type="hidden" name="_csrf" value="WUlQWFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">

            <input type="hidden" id="gastos_entrada" name="gastos_entrada" value="<?= $entrada ?>">

            <input type="hidden" id="gastos_salida" name="gastos_salida" value="<?= $salida ?>">

            <input type="hidden" id="gastos_gastos" name="gastos_gastos" value="<?= $id_gastos ?>">

            <button class="btn-primary" style= 'height:33px;width: 100%'><i class="fa fa-print">  </i> Exportar a Excel</button>
        </form>
    </div>
</div>

<?php
if ($entrada != "") {
    $fe = explode("-", $entrada);
    $entrada = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

    $fe = explode("-", $salida);
    $salida = $fe[2] . '-' . $fe[1] . '-' . $fe[0];
}
?>

<?php
if ($id_gastos != '') {
    $nom = Gastos::findAll(['id' => $id_gastos]);
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($entrada == "") { ?>
                        <i class="fa fa-bed fa-2x"></i>  REPORTE DE GASTOS  
                    <?php } else { ?>
                        <i class="fa fa-bed fa-2x"></i>  REPORTE DEL GASTO <?php echo "<b>" . $nom[0]->nombre . "</b>" ?> DEL  <?php echo "<b>" . $entrada . "</b>" ?> HASTA  <?php echo "<b>" . $salida . "</b>" ?>
                    <?php }
                    ?>

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->

                    <table  class="table table-striped table-bordered" id="report">

                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">U/M</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Importe</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $model = array();
                            if (isset($gastos)) {
                                $model = $gastos;
                            }
//                        print_r($enviar);
//                        die;


                            $total = 0;
                            for ($i = 0; $i < count($model); $i++) {
                                $total+=$model[$i]['importe'];
                                $nom = frontend\models\Unidad::findAll(['id' => $model[$i]['unidad']]);
                                $fecha = explode('-', $model[$i]['fecha']);
                                $entrada = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];



                                $dpto = frontend\models\Dpto::find()->where(['gastos' => $model[$i]['gastos']])->all();
                                if (count($dpto) != 0) {
                                    $nom[0]->nombre = 'PAGO';
                                }
                                ?>

                                <tr >
                                    <th class="text-center" ><?php echo $entrada ?></th>
                                    <th class="text-center" ><?php echo $nom[0]->nombre ?></th>
                                    <th class="text-center" ><?php echo Yii::$app->formatter->asDecimal($model[$i]['cant'], 2) ?></th>
                                    <th class="text-center" ><?php echo Yii::$app->formatter->asDecimal($model[$i]['importe'], 2) ?></th>



                                </tr>
                                <?php
                            }
                            ?>
                            <tr >
                                <th class="text-center" ></th>
                                <th class="text-center" ></th>
                                <th class="text-center" >TOTAL</th>
                                <th class="text-center" ><?php echo Yii::$app->formatter->asDecimal($total, 2) ?></th>



                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
<?php } else {
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($entrada == "") { ?>
                        <i class="fa fa-bed fa-2x"></i>  REPORTE DE GASTOS  
                    <?php } else { ?>
                        <i class="fa fa-bed fa-2x"></i>  REPORTE DE GASTOS DE  <?php echo "<b>" . $entrada . "</b>" ?> HASTA  <?php echo "<b>" . $salida . "</b>" ?>
                    <?php }
                    ?>

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->

                    <table  class="table table-striped table-bordered" id="report22">

                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">Producto</th>
                                <th class="text-center">U/M</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Importe</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $model = array();
                            if (isset($gastos)) {
                                $model = $gastos;
                            }
//                        print_r($enviar);
//                        die;
                            $total = 0;
                            for ($i = 0; $i < count($model); $i++) {
                                $total+=$model[$i]['imp'];

                                $dpto = frontend\models\Dpto::find()->where(['gastos' => $model[$i]['gastos']])->all();
                                if (count($dpto) != 0) {
                                    $model[$i]['unidad'] = 'PAGO';
                                }
                                ?>

                                <tr >
                                    <th class="text-center" ><?php echo $model[$i]['servicio'] ?></th>
                                    <th class="text-center" ><?php echo $model[$i]['unidad'] ?></th>
                                    <th class="text-center" ><?php echo Yii::$app->formatter->asDecimal($model[$i]['cant'], 2) ?></th>
                                    <th class="text-center" ><?php echo Yii::$app->formatter->asDecimal($model[$i]['imp'], 2) ?></th>



                                </tr>
                                <?php
                            }
                            ?>
                            <tr >
                                <th class="text-center" ></th>
                                <th class="text-center" ></th>
                                <th class="text-center" >TOTAL</th>
                                <th class="text-center" ><?php echo Yii::$app->formatter->asDecimal($total, 2) ?></th>



                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <?php
}
?>