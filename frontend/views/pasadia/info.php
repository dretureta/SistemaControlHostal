<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\ReservacionServicios;
use frontend\models\Reservacion;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\assets\AppAsset;

$asset = AppAsset::register($this);



$this->title = 'LISTADO DE SERVICIOS DE : ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'PASADIA', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//print_r(time('h:m'));die;


$id_pasadia = $model->id;
$cont = 0;
$imp = 0;
$resultado = array();
$connection = \Yii::$app->db;
$connection->open();

$command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,pasadia_servicio,pasadia where servicio.id=subservicios.servicio and subservicios.id=pasadia_servicio.servicio and  pasadia_servicio.pasadia=pasadia.id and pasadia.id=:pasa GROUP BY servicio.nombre ORDER BY servicio.prioridad');
$command->bindParam(':pasa', $id_pasadia);
$result = $command->queryAll();



for ($i = 0; $i < count($result); $i++) {
    $command1 = $connection->createCommand('select subservicios.nombre, pasadia_servicio.cant as cant,pasadia_servicio.precio,pasadia_servicio.cant*pasadia_servicio.precio as total,pasadia_servicio.id,pasadia_servicio.incluir  from subservicios,pasadia_servicio,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=pasadia_servicio.servicio and pasadia_servicio.pasadia=:pasa ORDER BY subservicios.nombre');
    $command1->bindParam(':serv', $result[$i]['id']);
    $command1->bindParam(':pasa', $id_pasadia);
    $subservicios = $command1->queryAll();



//    $resultado[count($resultado)] = array(
//        'desc' => '<h6>' . $result[$i]['nombre'] . '</h6>',
//        'cant' => ' ',
//        'precio' => ' ',
//        'total' => ' ',
//        'id' => ''
//    );
//    $cont++;



    for ($k = 0; $k < count($subservicios); $k++) {
        if ($subservicios[$k]['incluir'] == 1) {
            $resultado[count($resultado)] = array(
                'desc' => $subservicios[$k]['nombre'] . '   <b>(NO FACTURA)</b> ',
                'cant' => $subservicios[$k]['cant'],
                'precio' => $subservicios[$k]['precio'],
                'total' => $subservicios[$k]['total'],
                'id' => $subservicios[$k]['id'],
            );
            $cont++;
            $imp+=$subservicios[$k]['total'];
        }

        if ($subservicios[$k]['incluir'] == 2) {

            $resultado[count($resultado)] = array(
                'desc' => $subservicios[$k]['nombre'] . '  <b>(NO INGRESO)</b>',
                'cant' => $subservicios[$k]['cant'],
                'precio' => $subservicios[$k]['precio'],
                'total' => $subservicios[$k]['total'],
                'id' => $subservicios[$k]['id'],
            );
        }

        if ($subservicios[$k]['incluir'] == 0) {
            $resultado[count($resultado)] = array(
                'desc' => $subservicios[$k]['nombre'],
                'cant' => $subservicios[$k]['cant'],
                'precio' => $subservicios[$k]['precio'],
                'total' => $subservicios[$k]['total'],
                'id' => $subservicios[$k]['id'],
            );
            $cont++;
            $imp+=$subservicios[$k]['total'];
        }
    }
}
//print_r($resultado);die;
$resultado[count($resultado)] = array(
    'desc' => '',
    'cant' => '',
    'precio' => '<h6>TOTAL</h6>',
    'total' => '<h6>' . Yii::$app->formatter->asDecimal($imp, 2) . ' CUC </h6>',
    'id' => ''
);
?>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <div class="agencia-create">

            <table  class="table table-striped table-bordered" id="pdia">
                <thead class="bg-primary">
                    <tr style="height: 30px">
                        <th class="">SERVICIO</th>
                        <th class="text-center">CANTIDAD</th>
                        <th class="text-center">PRECIO</i></th>
                        <th class="text-center">IMPORTE</i></th>
                        <th class="text-center"></i>OPCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($resultado); $i++) {
                        $id = $resultado[$i]['id'];
                        ?>
                        <tr>
                            <th class=""><?php echo $resultado[$i]['desc'] ?></th>
                            <th class="text-center"><?php echo $resultado[$i]['cant'] ?></th>
                            <th class="text-center"><?php echo $resultado[$i]['precio'] ?></i></th>
                            <th class="text-center"><?php echo $resultado[$i]['total'] ?></i></th>
                            <th class="text-center"></i><a href="<?= \Yii::$app->urlManager->createUrl(['pasadia/deleteser', 'id' => $resultado[$i]['id'], 'pasa' => $id_pasadia]); ?>" data-confirm="Estas seguro que deseas eliminar el servicio"><i class="fa fa-remove"></i></a></th>
                        </tr>


                    <?php }
                    ?>
                </tbody>

            </table>
            <div class="col-md-11"></div>
            <div class="col-md-1" style="margin-top: 1.8em">
                <p><a href="<?= \Yii::$app->urlManager->createUrl(['pasadia/servicio', 'id' => $model->id]); ?>" class="btn btn-danger">Terminar</a></p>

            </div>
        </div>
    </div>
</div>




