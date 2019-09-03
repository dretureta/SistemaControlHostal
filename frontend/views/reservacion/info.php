<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\ReservacionServicios;
use frontend\models\Reservacion;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\assets\AppAsset;

$asset = AppAsset::register($this);

$resinfo = Reservacion::findOne(['id' => $id_res]);

$this->title = 'LISTADO DE SERVICIOS DE : ' . $resinfo->nombre_cliente;
$this->params['breadcrumbs'][] = ['label' => 'RESERVACIONES', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//print_r(count($serv));die;
?>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <div class="agencia-create">

            <table id="pdia" class="table table-striped table-bordered" >
                <thead class="bg-primary">
                    <tr>
                        <th class="">SERVICIO</th>
                        <th class="text-center">HAB</th>
                        <th class="text-center">CANTIDAD</th>
                        <th class="text-center">PRECIO</i></th>
                        <th class="text-center">IMPORTE</i></th>
                        <th class="text-center">FECHA</i></th>
                        <th class="text-center"></i>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($aloj); $i++) {

                        $start_ts = strtotime($aloj[$i]['fecha_entrada']);
                        $end_ts = strtotime($aloj[$i]['fecha_salida']);
                        $diferencia = $end_ts - $start_ts;
                        $dif_dias = round($diferencia / 86400);
                        //print_r($dif_dias);die;
                        $imp=$dif_dias*$aloj[$i]->precio;
                        ?>
                        <tr>
                            <th class="text-justify"><?php echo $aloj[$i]->reservacion0->nombre_cliente . " (NO FACTURA)" ?></th>
                            <th class="text-center"><?php echo $aloj[$i]->hab0->nombre ?></th>
                            <th class="text-center"><?php echo $dif_dias." (NOCHES)" ?></th>
                            <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($aloj[$i]->precio, 2) ?></th>                            
                            <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($imp, 2) ?></th>
                            <th class="text-center"><?php echo "" ?></th>
                            <th class="text-center"></th>
                        </tr>

    <?php
}

for ($i = 0; $i < count($serv); $i++) {
    ?>
                        <tr>

    <?php if ($serv[$i]->estado == 2) { ?>
                                <th class=""><?php echo $serv[$i]->servicio0->nombre . " (NO INGRESO)" ?></th>
                            <?php } elseif ($serv[$i]->estado == 1) { ?>
                                <th class=""><?php echo $serv[$i]->servicio0->nombre . " (NO FACTURA)" ?></th>
                            <?php } else {
                                ?>
                                <th class=""><?php echo $serv[$i]->servicio0->nombre ?></th>
                                <?php
                            }
                            ?>
                            <th class="text-center"><?php echo $serv[$i]->hab0->nombre ?></th>
                            <th class="text-center"><?php echo $serv[$i]->cant ?></th>
                            <th class="text-center"><?php echo $serv[$i]->precio ?></th>
                            <th class="text-center"><?php echo $serv[$i]->cant * $serv[$i]->precio ?></th>
                            <th class="text-center"><?php
                        $fe = explode("-", $serv[$i]->fecha);
                        echo $fe[2] . "-" . $fe[1] . "-" . $fe[0]
                            ?></th>

                            <th class="text-center">
                                <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/delete_serv', 'id' => $serv[$i]->id, 'res' => $id_res]); ?>" data-confirm="Estas seguro que deseas eliminar el servicio"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>      

                            </th>
                        </tr>
    <?php
//                        $id_serv = $serv[$i]->servicio;
//                        
//                        $subserv = ReservacionServicios::find()
//                                ->where(['reservacion_servicios.reservacion' => $id_res])
//                                ->andWhere(['subservicios.id' => $id_serv])
//                                ->andWhere(['reservacion_servicios.estado' => 0])
//                                ->orderBy('subservicios.nombre asc')
//                                ->all();
}
?>
                </tbody>
            </table>

            <div class="col-md-11"></div>
            <div class="col-md-1" style="margin-top: 1.8em">
                <p><a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/servicio', 'id' => $id_res]); ?>" class="btn btn-danger">Terminar</a></p>

            </div>
        </div>
    </div>
</div>




