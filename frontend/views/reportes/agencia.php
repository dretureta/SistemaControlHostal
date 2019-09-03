<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Agencia;
use frontend\models\ReservacionHab;
use frontend\models\Subservicios;
use frontend\models\Servicio;
use frontend\models\Reservacion;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */

$this->title = 'REPORTES DE AGENCIAS';
$this->params['breadcrumbs'][] = ['label' => 'REPORTES', 'url' => ['agencia']];
$this->params['breadcrumbs'][] = $this->title;


$agencia = Agencia::find()->orderBy("nombre")->all();
$mes = array();
$mes[count($mes)] = array('id' => '01', 'mes' => 'Enero');
$mes[count($mes)] = array('id' => '02', 'mes' => 'Febrero');
$mes[count($mes)] = array('id' => '03', 'mes' => 'Marzo');
$mes[count($mes)] = array('id' => '04', 'mes' => 'Abril');
$mes[count($mes)] = array('id' => '05', 'mes' => 'Mayo');
$mes[count($mes)] = array('id' => '06', 'mes' => 'Junio');
$mes[count($mes)] = array('id' => '07', 'mes' => 'Julio');
$mes[count($mes)] = array('id' => '08', 'mes' => 'Agosto');
$mes[count($mes)] = array('id' => '09', 'mes' => 'Septiembre');
$mes[count($mes)] = array('id' => '10', 'mes' => 'Octubre');
$mes[count($mes)] = array('id' => '11', 'mes' => 'Noviembre');
$mes[count($mes)] = array('id' => '12', 'mes' => 'Diciembre');

$cliente = Reservacion::find()->orderBy('nombre_cliente asc')->all();
?>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-search"></i> CONCILIACIONES </h6>
    </div>
    <div class="panel-body">
        <form method="post" id="repagencia_validar" action="<?= \Yii::$app->urlManager->createUrl(['reportes/infoagencia']); ?>">
            <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
            <div class="row">


                <div class="col-md-3">
                    <b>Fecha Inicial</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input type="text" id="rep_inicial" class="form-control" name="rep_inicial" placeholder="Fecha Inicial" value="" required="required">
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
                            <select id="rep_agencia" class="form-control" name="rep_agencia"  aria-required="true" >
                                <option value="">Seleccione Agencia</option>
                                <?php for ($i = 0; $i < count($agencia); $i++) { ?>
                                    <option value="<?php echo $agencia[$i]->id ?>"><?php echo $agencia[$i]->nombre ?></option> 
                                <?php }
                                ?>
                            </select>                                                  
                        </div>
                    </div>



                </div>


                <div class="col-md-4">
                    <b>Cliente</b>
                    <div class="form-group form-float input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-line">
                            <select id="rep_cliente" class="form-control" name="rep_cliente"  aria-required="true">
                                <option value="">Seleccione Cliente</option>
                                <?php for ($i = 0; $i < count($cliente); $i++) { ?>
                                    <option value="<?php echo $cliente[$i]->nombre_cliente ?>"><?php echo $cliente[$i]->nombre_cliente ?></option> 
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

        <form method="post" id="exportarexcel" action="<?= \Yii::$app->urlManager->createUrl(['reportes/agencia-excel']); ?>">
            <input type="hidden" name="_csrf" value="WUlQWFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">

            <input type="hidden" id="mesexcel" name="mesexcel" value="<?= $mesexcel ?>">

            <input type="hidden" id="agenciaexcel" name="agenciaexcel" value="<?= $agenciaexcel ?>">

            <input type="hidden" id="clienteexcel" name="clienteexcel" value="<?= $clienteexcel ?>">

            <button class="btn-primary" style= 'height:33px;width: 100%'><i class="fa fa-print">  </i> Exportar a Excel</button>
        </form>
    </div>
</div>

<?php
$nomcliente = "";
if ($clienteexcel != 0) {
    $nomcliente = ' <b style="margin-left: 3em">Cliente :</b>  ' . $enviar[0]['nombre'];
}
$nommes = "";
for ($i = 0; $i < count($mes); $i++) {
    if ($mes[$i]['id'] == $mesexcel) {
        $nommes = ' <b style="margin-left: 3em">Mes :</b>  ' . $mes[$i]['mes'];
    }
}
if ($mesexcel!="") {
    $nommes=' <b style="margin-left: 3em">Mes :</b>  ' .$mesexcel;
}
$nomagencia = "";
if ($agenciaexcel != "") {
    $nomagencia1 = Agencia::findAll(['id' => $agenciaexcel]);
    $nomagencia = ' <b style="margin-left: 3em">Agencia :</b>  ' . $nomagencia1[0]->nombre;
}
?>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bed fa-2x"></i>  SERVICIOS DE ALOJAMIENTO <?= $nommes . $nomagencia . $nomcliente ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->

                <table  class="table table-striped table-bordered" id="reportes">

                    <thead class="bg-primary">
                        <tr>
                            <th class="text-center">Código</th>
                            <th class="text-center">Servicio</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Fecha Entrada</th>
                            <th class="text-center">Cantidad de Habitaciones</th>
                            <th class="text-center">Ocupacion</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Noches</th>
                            <th class="text-center">Importe</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $model = array();
                        if (isset($enviar)) {
                            $model = $enviar;
                        }
//                        print_r($enviar);
//                        die;
                        for ($i = 0; $i < count($model); $i++) {
                            $fecha_ent = "";
                            if ($i < count($model) - 1) {

                                $fe_en = explode('-', $model[$i]['fecha']);
                                $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];
                            }
                            ?>

                            <tr >
                                <th class="text-center" ><?php echo $model[$i]['codigo'] ?></th>
                                <th class="text-center" ><?php echo $model[$i]['servicio'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['nombre'] ?></th>
                                <th class="text-center"><?php echo $fecha_ent ?></th>
                                <th class="text-center"><?php echo $model[$i]['cant'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['ocupacion'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['plan'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['precio'] ?></th>
                                <th class="text-center"><?php echo $model[$i]['noches'] ?></th>
                                <th class="text-center" ><?php echo $model[$i]['subtotal'] ?></th>


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


<?php //print_r($serv);die;   ?>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bed fa-2x"></i>  SERVICIOS EXTRAS INCLUIDOS
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->

                <table  class="table table-striped table-bordered" id="reportes_extra">

                    <thead class="bg-primary">
                        <tr>
                            <th>Nombre</th>                            
                            <th>Fecha</th>
                            <th>Servicio</th>
                            <th>Subservicio</th>
                            <th>Cant</th>
                            <th>Precio</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($serv)) {
                            $model = $serv;
                        }

                        for ($i = 0; $i < count($model); $i++) {
//    print_r($model);die;
                            ?>

                            <tr>

                                <th><?php echo $model[$i]['nombre'] ?></th>                               
                                <th><?php echo $model[$i]['fecha'] ?></th>                                
                                <th><?php echo $model[$i]['servicio'] ?></th>                                
                                <th><?php echo $model[$i]['nombre_servicio'] ?></th> 
                                <th><?php echo $model[$i]['cantidad'] ?></th>
                                <th><?php echo $model[$i]['precio'] ?></th>
                                <th><?php echo $model[$i]['subtotal'] ?></th>


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

