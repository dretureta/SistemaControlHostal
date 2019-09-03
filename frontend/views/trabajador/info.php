<?php

use yii\helpers\Html;
use frontend\models\TrabFunciones;
use frontend\models\Trabajador;

/* @var $this yii\web\View */
/* @var $model frontend\models\Trabajador */

$this->title = 'INFO TRABAJADOR';
$this->params['breadcrumbs'][] = ['label' => 'TRABAJADOR', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$fecha = date('Y-m');
$mod_date1 = strtotime($fecha . "- 1 month");
$fe_terminada = date("Y-m", $mod_date1) . '-01';

$trab1=  Trabajador::findAll(['id' => $id]);
//print_r($trab1);
//die();
$funciones = TrabFunciones::find()->where(['trab' => $id])->andWhere(['>=', 'fecha', $fe_terminada])->orderBy('fecha desc')->all();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title).' '.$trab1[0]->nombre ?></h3>
    </div>
    <div class="panel-body">
        <div class="agencia-create">

            <table  class="table table-striped table-bordered" id="pendientes" >
                <thead class="bg-primary">
                    <tr> 
                        <th><b  style="margin-left: 1em">FECHA</b></th>
                        <th><b style="margin-left: 1em">FUNCION</b></th>
                        <th><b style="margin-left: 1em">CANTIDAD</b></th>
                        <th><b style="margin-left: 1em">PRECIO</b></th>
                        <th><b style="margin-left: 0.5em">IMPORTE</b></th>
                        <th><b style="margin-left: 2em"><i class="fa fa-wrench"> </b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    for ($i = 0; $i < count($funciones); $i++) {
                        $fe=  explode("-", $funciones[$i]->fecha);
                        $fecha=$fe[2]."-".$fe[1]."-".$fe[0];
                        $total+=$funciones[$i]->cantidad * $funciones[$i]->precio;
                        ?>
                        <tr> 
                            <th><b  style="margin-left: 1em"><?php echo $fecha ?></b></th>
                            <th><b style="margin-left: 1em"><?php echo $funciones[$i]->func0->nombre ?></b></th>
                            <th><b style="margin-left: 1em"><?php echo $funciones[$i]->cantidad ?></b></th>
                            <th><b style="margin-left: 1em"><?php echo $funciones[$i]->precio ?></b></th>
                            <th><b style="margin-left: 0.5em"><?php echo $funciones[$i]->cantidad * $funciones[$i]->precio ?></b></th>
                            <th><b style="margin-left: 2em">
                                    <a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/deletefun', 'id' => $funciones[$i]->id, 'trab' => $id]); ?>" data-confirm="Estas seguro que deseas eliminar la función"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
                                </b>
                            </th>
                        </tr>
                    <?php }
                    ?>
                    <tr> 
                        <th><b  style="margin-left: 1em"></b></th>
                        <th><b style="margin-left: 1em"></b></th>
                        <th><b style="margin-left: 1em"></b></th>
                        <th><b style="margin-left: 1em">TOTAL</b></th>
                        <th><b style="margin-left: 0.5em"><?php echo $total ?></b></th>
                        <th><b style="margin-left: 2em">

                            </b>
                        </th>
                    </tr>
                </tbody>
            </table>
            <div class="col-md-11"></div>
            <div class="col-md-1" style="margin-top: 1.8em">
                <p><a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/funciones', 'id' => $id]); ?>" class="btn btn-danger">Terminar</a></p>

            </div>
        </div>
    </div>
</div>
