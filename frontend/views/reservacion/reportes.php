<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Reservacion;
use frontend\models\ReservacionServicios;
use frontend\models\Gastos;

$this->title = 'REPORTES';
$this->params['breadcrumbs'][] = ['label' => 'RESERVACIÓN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$connection = \Yii::$app->db;
$connection->open();

$command = $connection->createCommand('select reservacion.id,reservacion_hab.precio,reservacion.nombre_cliente,reservacion.fecha_entrada,reservacion.fecha_salida,agencia.nombre as agencia,reservacion.obs,reservacion_hab.hab,habitacion.nombre from reservacion,agencia,habitacion,reservacion_hab where reservacion.id=reservacion_hab.reservacion and reservacion_hab.hab=habitacion.id and reservacion.agencia=agencia.id and reservacion.estado=2  GROUP BY reservacion_hab.hab,reservacion.id order by reservacion.fecha_entrada desc');
$activas = $command->queryAll();



$command1 = $connection->createCommand('SELECT * FROM addgastos order by fecha desc');
$gastos = $command1->queryAll();






if (count($rep_reservas) != 0 || count($rep_gastos) != 0) {
    $activas = $rep_reservas;
    $gastos = $rep_gastos;
}

$gas = 0;
for ($i = 0; $i < count($gastos); $i++) {
    $gas+=$gastos[$i]['importe'];
}

//print_r($gastos);die;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-search"></i> BUSCAR </h6>
    </div>
    <div class="panel-body">
        <form method="post" action="<?= \Yii::$app->urlManager->createUrl(['reservacion/info']); ?>">
            <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
            <div class="row">
                <div class="col-md-5">               
                    <div class="form-group field-reservacion-fecha_entrada required">
                        <label class="control-label" for="reservacion-fecha_entrada"></label>
                        <div class="input-group date"><span class='input-group-addon'><i class="glyphicon glyphicon-calendar"></i></span><input type="text" id="reservacion-fecha_entrada" class="form-control" name="rep_entrada" placeholder="Seleccione Fecha Entrada" style="height: 45px;width: 100%;" aria-required="true" data-plugin-name="datepicker" data-plugin-options="datepicker_4a29739b"></div>

                        <div class="help-block"></div>
                    </div> 
                </div>
                <div class="col-md-5">
                    <div class="form-group field-reservacion-fecha_entrada required">
                        <label class="control-label" for="reservacion-fecha_entrada"></label>
                        <div class="input-group date"><span class='input-group-addon'><i class="glyphicon glyphicon-calendar"></i></span><input type="text" id="reservacion-fecha_salida" class="form-control" name="rep_salida" placeholder="Seleccione Fecha Entrada" style="height: 45px;width: 100%;" aria-required="true" data-plugin-name="datepicker" data-plugin-options="datepicker_4a29739b"></div>

                        <div class="help-block"></div>
                    </div> 
                </div>
                <div class="col-md-2"style="margin-top: -2em">  

                    <button class="btn-success" style= 'height: 40px;margin-top:3.5em;;width: 100%'><i class="fa fa-search">  </i>    Buscar</button>  

                </div>
            </div>
        </form>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bed fa-2x"></i>  HISTORIAL DE RESERVACIONES 
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->

                <table  class="table table-striped table-bordered" id="reportes">

                    <thead class="bg-primary">
                        <tr>
                            <th><i class="fa fa-user fa-2x"></i> NOM CLIENTE</th>
                            <th><i class="fa fa-calendar fa-2x"></i></th>
                            <th><i class="fa fa-calendar fa-2x"></i></th>
                            <th><i class="fa fa-bed fa-2x"></i></th>
                            <th>AGENCIA</th>
                            <th>OBSERVACIONES</th>
                            <th><i class="fa fa-wrench"> </th>
                        </tr>
                    </thead>
                    <tbody>

<?php
$sum = 0;
for ($i = 0; $i < count($activas); $i++) {

    $serv = ReservacionServicios::find()->where(['reservacion' => $activas[$i]['id']])->andWhere(['hab' => $activas[$i]['hab']])->all();
    for ($j = 0; $j < count($serv); $j++) {
        $sum+=$serv[$j]->cant * $serv[$j]->precio;
    }

    $start_ts = strtotime($activas[$i]['fecha_entrada']);
    $end_ts = strtotime($activas[$i]['fecha_salida']);
    $diferencia = $end_ts - $start_ts;
    $dif_dias = round($diferencia / 86400);

    $sum+=$dif_dias * $activas[$i]['precio'];
    ?>

                            <tr>
                                <th><?php echo $activas[$i]['nombre_cliente'] ?></th>
                                <th><?php echo $activas[$i]['fecha_entrada'] ?></th>
                                <th><?php echo $activas[$i]['fecha_salida'] ?></th>
                                <th><?php echo $activas[$i]['nombre'] ?></th>
                                <th><?php echo $activas[$i]['agencia'] ?></th>
                                <th><?php echo $activas[$i]['obs'] ?></th>
                                <th> 
                                    <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/servicio', 'id' => $activas[$i]['id']]); ?>" ><i class="fa fa-adn" data-toggle="tooltip" data-placement="top" title="Servicio"></i></a>

                                </th>

                            </tr>
<?php }
?>
                        <tr>
                            <th></th>
                            <th></th>  
                            <th></th>  
                            <th><label class="label-success">Utilidad: <?php echo $sum ?></label></th>
                            <th><label class="label-danger">Gastos: <?php echo $gas ?></label></th>
                            <th><label class="label-primary">Util Neta: <?php echo $sum - $gas ?></label></th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>