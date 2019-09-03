
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Agencia;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

//$subservicios = Subservicios::find()->all();
$agencia = Agencia::find()->orderBy("nombre")->all();
$this->title = 'REPORTES DE PASADIA';
$this->params['breadcrumbs'][] = ['label' => 'REPORTES', 'url' => ['pasadia']];
$this->params['breadcrumbs'][] = $this->title;
?>

<br>
<div class="panel panel-default">
    <div class="panel-heading">
       <h6 class="panel-title">BUSCAR PASADIA </h6>
    </div>
    <div class="panel-body">
        <form method="post" id="repagencia_validar" action="<?= \Yii::$app->urlManager->createUrl(['reportes/infopasadia']); ?>">
            <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
            <div class="row">






                <div class="col-md-3">
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




                <div class="col-md-3">
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
                    <b>Agencia</b>


                    <div class="form-group form-float input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">settings</i>
                        </span>
                        <div class="form-line">
                            <select id="pasadia_agencia2" class="form-control" name="pasadia_agencia"  aria-required="true" >
                                <option value="">Seleccione Agencia</option>
                                <?php for ($i = 0; $i < count($agencia); $i++) { ?>
                                    <option value="<?php echo $agencia[$i]->id ?>"><?php echo $agencia[$i]->nombre ?></option>
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

        <form method="post" id="exportarexcel" action="<?= \Yii::$app->urlManager->createUrl(['reportes/pasadia-excel']); ?>">
            <input type="hidden" name="_csrf" value="WUlQWFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">

            <input type="hidden" id="mesexcel" name="entrada" value="<?= $entrada ?>">

            <input type="hidden" id="agenciaexcel" name="salida" value="<?= $salida ?>">

            <input type="hidden" id="agenciaexcel" name="agencia" value="<?= $agen ?>">




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
                <i class="fa fa-dollar"></i>  REPORTE DE PASA DIA DE <?php echo "<b>" . $entrada . "</b>" ?> HASTA <?php echo "<b>" . $salida . "</b>" ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->

                <table  class="table table-striped table-bordered" id="reportes_ingreso">

                    <thead class="bg-primary">
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Agencia</th>
                            <th class="text-center">Fecha Entrada</th>
                            <th class="text-center">Importe</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $model = array();
                        if (isset($dia)) {
                            $model = $dia;
                        }
//                        print_r($enviar);
//                        die;


                        $suma_total = 0;
                        for ($i = 0; $i < count($model); $i++) {


                            $suma_total = $suma_total + $model[$i]['imp'];
                            ?>

                            <tr >


                                <th class="text-center" ><?php echo $model[$i]['nombre'] ?></th>
                                <th class="text-center" ><?php echo $model[$i]['agencia'] ?></th>
                                <th class="text-center" ><?php echo $model[$i]['fecha'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['imp'] ?></th>
                                <th class="text-center"><a href="<?= \Yii::$app->urlManager->createUrl(['pasadia/servicio', 'id' => $model[$i]['id']]); ?>" > VER  FACTURA </a></th>

                            </tr>
                            <?php
                        }
                        ?>

                        <tr>
                            <th class="text-center" ><?php ?></th>
                            <th class="text-center" ><?php ?></th>
                            <th class="text-center" ><?php ?></th>
                            <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($suma_total, 2) ?></th>

                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
