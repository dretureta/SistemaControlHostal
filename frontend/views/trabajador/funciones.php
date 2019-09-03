<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use frontend\models\TrabFunciones;
use frontend\models\Trabajador;
use frontend\models\DptoFunciones;

$asset = AppAsset::register($this);

$trab = Trabajador::findAll(['id' => $id]);

$this->title = 'ADICIONAR FUNCIONES AL TRABAJADOR: ' . ' ' . $trab[0]->nombre;
$this->params['breadcrumbs'][] = ['label' => 'TRABAJADORES', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$connection = \Yii::$app->db;
$connection->open();


$id_dpto = $trab[0]->dpto;
//print_r($id_dpto);die;

$command = $connection->createCommand('select funciones.id,funciones.nombre FROM funciones,dpto_funciones where dpto_funciones.dpto=:dpto and dpto_funciones.func=funciones.id ORDER BY funciones.nombre');
$command->bindParam(':dpto', $id_dpto);
$dpto = $command->queryAll();
$connection->close();

//$dpto = DptoFunciones::find()->where(['dpto' => $trab[0]->dpto])->all();

$salario = 0;
$func = TrabFunciones::find()->where(['trab' => $id])->andWhere(['estado' => 0])->all();
for ($i = 0; $i < count($func); $i++) {
    $salario+=$func[$i]->precio * $func[$i]->cantidad;
}

$fe = '%' . date('Y-m') . '%';
$id_trab = $trab[0]->id;

$command = $connection->createCommand('SELECT trab_funciones.fecha FROM trab_funciones WHERE trab_funciones.trab=:trab and (trab_funciones.fecha LIKE :fecha or trab_funciones.estado=0) GROUP BY trab_funciones.fecha ORDER BY trab_funciones.fecha asc');
$command->bindParam(':fecha', $fe);
$command->bindParam(':trab', $id_trab);
$fechas = $command->queryAll();
//$connection->close();

$command1 = $connection->createCommand('SELECT trab_funciones.fecha FROM trab_funciones WHERE trab_funciones.trab=:trab and trab_funciones.estado=1 GROUP BY trab_funciones.fecha ORDER BY trab_funciones.fecha desc');
$command1->bindParam(':trab', $id_trab);
$fechaspagadas = $command1->queryAll();
$connection->close();

$ultimaq_fechapagada = "";
if (count($fechaspagadas) != 0) {
    $ultimaq_fechapagada = $fechaspagadas[0]['fecha'];
}



//$fechas = TrabFunciones::find()->where(['like', 'fecha', $fe])->orWhere(['estado'=> 0])->andWhere(['trab' => $trab[0]->id])->groupBy(['fecha'])->all();
//print_r($ultimaq_fechapagada);
//die;
?>
<div class="row" style="margin-top: 0.5em">

    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-plus"></i> <?php echo "ACUMULADO DE " . $trab[0]->nombre . ' : ' . Yii::$app->formatter->asDecimal($salario, 2) . " CUC" ?> </h3>
            </div>
            <div class="panel-body">
                <form method="post" id="repagencia_validar" action="<?= \Yii::$app->urlManager->createUrl(['trabajador/addfunciones']); ?>">
                    <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
                    <input type="hidden" name="id" value="<?php echo $trab[0]->id ?>">
                    <div class="row">

                        <div class="col-md-7">                          

                            <b>Actividad</b>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">settings</i>
                                </span>
                                <div class="form-line">
                                    <select id="id_func" class="form-control" name="id_func">
                                        <option value="">Seleccione Actividad</option>
                                        <?php for ($i = 0; $i < count($dpto); $i++) { ?>
                                            ?>
                                            <option value="<?php echo $dpto[$i]["id"] ?>"><?php echo $dpto[$i]["nombre"] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-5">
                            <b>Precio</b>

                            <div class="form-group form-float input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">monetization_on</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" id="precio" name="precio" class="form-control"   placeholder="" required="" aria-required="true" value="" disabled="true">                                   
                                </div>
                            </div>                            
                        </div>


                        <div class="col-md-7">                            
                            <b>Cantidad</b>
                            <div class="form-group form-float input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">add_circle</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" id="cant" disabled="true" name="cant" class="form-control"   placeholder="" required="" aria-required="true">                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5" style="margin-top: 1em">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input required="required" class="form-control" type="text" id="fecha_func" name="fecha_func" placeholder="Fecha" value="<?php echo date('d-m-Y') ?>" >

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button class="btn-success" style= 'height:32px;width: 72%' id="bofunciones"><i class="fa fa-plus">  </i> ADICIONAR</button>
                            </div>
                        </div>

                        <div class="col-md-6" style="margin-top: 0.8em">
                            <a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/index']); ?>" class="btn btn-danger text-center" style="height: 35px;width: 72%" ><i class="fa fa-arrow-circle-left">  </i><b> TERMINAR</b></a>

                        </div>

                    </div>


                </form>
            </div>

        </div>
    </div>

    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> ACTIVIDADES DEL TRABAJADOR : <?php echo $trab[0]->nombre ?></h3>
            </div>
            <div class="panel-body" style="width: 100%;height: 525px;">
                <div class="agencia-create">

                    <style>
                        .wrap table {
                            width: 100%;
                            table-layout: fixed;
                            //margin-left: 2em;
                        }

                        .inner_table {
                            height: 400px;
                            overflow-y: auto;
                        }
                    </style>

                    <div class="wrap">
                        <table class="head" border="0" width="230px">
                            <tr style="background-color:#337ab7;color: white;height: 35px"> 
                                <th width="30px" ><b  style="margin-left: 1em">FECHA</b></th>
                                <th width="86px"><b style="margin-left: 2em">FUNCION</b></th>
                                <th width="40px" ><b style="margin-left: 2em;">CANTIDAD</b></th>
                                <th width="29px"><b style="margin-left: 0.5em;">PRECIO</b></th>
                                <th width="26px"><b style="margin-left: 0.5em">IMPORTE</b></th>
                                <th width="23px"><b style="margin-left: 2em;"><i class="fa fa-wrench"> </b></th>
                            </tr> 
                        </table>
                        <div class="inner_table">
                            <table  class="table-bordered" id="" style="width: 100%;">

                                <tbody>
                                    <?php
                                    $id = $trab[0]->id;
                                    $color = 0;

                                    for ($i = 0; $i < count($fechas); $i++) {
//                                        $mostrar = TrabFunciones::find()->where(['fecha' => $fechas[$i]->fecha])->andWhere(['trab' => $trab[0]->id])->all();
                                        $fe = $fechas[$i]["fecha"];

                                        $connection = \Yii::$app->db;
                                        $connection->open();

                                        $command = $connection->createCommand('SELECT trab_funciones.id,trab_funciones.trab,trab_funciones.func,SUM(trab_funciones.cantidad) as cantidad,trab_funciones.precio,funciones.nombre,funciones.id as id_func,trab_funciones.estado from trab_funciones,funciones where fecha = :fecha and trab=:trab and trab_funciones.func=funciones.id GROUP BY func,precio');
                                        $command->bindParam(':fecha', $fe);
                                        $command->bindParam(':trab', $id);
                                        $mostrar = $command->queryAll();
                                        $connection->close();

//                                        print_r($mostrar);
//                                        die;
                                        $fe = explode('-', $fechas[$i]["fecha"]);
                                        $fec = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

                                        if ($color == 0) {
                                            if ($fechas[$i]["fecha"] == $ultimaq_fechapagada) {
                                                $color = 1;
                                            }
                                            ?>
                                            <tr>
                                                <th style="width:80px"><?php echo $fec ?></th>
                                                <th></th>
                                                <th style="width:90px"></th>
                                                <th style="width:70px"></th>
                                                <th style="width:80px"></th>
                                                <th style="width: 40px"></th>
                                            </tr>
                                        <?php } else { ?>
                                            <tr style="background-color: #FB483A">
                                                <th style="width:80px"><?php echo $fec ?></th>
                                                <th></th>
                                                <th style="width:90px"></th>
                                                <th style="width:70px"></th>
                                                <th style="width:80px"></th>
                                                <th style="width:40px"></th>
                                            </tr>
                                            <?php
                                            $color = 0;
                                        }
                                        ?>

                                        <?php
                                        $total = 0;
                                        for ($k = 0; $k < count($mostrar); $k++) {
                                            $total+=$mostrar[$k]['precio'] * $mostrar[$k]['cantidad'];
                                            ?>
                                            <tr>
                                                <th style="width:80px"></th>
                                                <th><?php echo $mostrar[$k]['nombre'] ?></th>
                                                <th style="text-align: center;width:90px"><?php echo $mostrar[$k]['cantidad'] ?></th>
                                                <th style="text-align: center;width:70px"><?php echo Yii::$app->formatter->asDecimal($mostrar[$k]['precio'], 2) ?></th>
                                                <th style="text-align: center;width:80px"><?php echo Yii::$app->formatter->asDecimal($mostrar[$k]['precio'] * $mostrar[$k]['cantidad'], 2) ?></th>
                                                <th style="text-align: center;width: 40px"><a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/defunciones', 'fecha' => $fechas[$i]["fecha"], 'trab' => $id, 'id' => $mostrar[$k]['id_func']]) ?>" data-confirm="Estas seguro que deseas eliminar la funciÃ³n"><i class="fa fa-remove"></i></a></th>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <th style="width:80px"></th>
                                            <th></th>
                                            <th style="width: 90px"></th>
                                            <th style="text-align: center;width:70px">TOTAL</th>
                                            <th style="text-align: center;width:80px "><?php echo Yii::$app->formatter->asDecimal($total, 2) ?></th>
                                            <th style="width: 40px"></th>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-3" style="margin-top: 0.8em">
                        <?php if ($salario != 0) { ?>                   

                            <a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/pagado', 'id' => $trab[0]->id]); ?>" class="btn btn-danger text-center" style="height: 35px;width: 90%" data-confirm="Estas seguro que deseas efectuar el pago"><i class="fa fa-dollar" >  </i><b> PAGAR</b></a>
                        <?php }
                        ?>
                    </div>

                    <div class="col-md-5" style="margin-top: 0.8em">


                    </div>

                    <div class="col-md-3" style="margin-top: 0.8em">
                        <a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/info', 'id' => $trab[0]->id]); ?>" class="btn btn-primary text-center" style="height: 35px;width: 90%"><i class="fa fa-info" >  </i><b> INFO</b></a>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>