<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\ReservacionHab;
use frontend\models\Habitacion;

$this->title = 'CAMBIAR DE HABITACÓN A: ' . ' ' . $model->nombre_cliente;
$this->params['breadcrumbs'][] = ['label' => 'RESERVACIONES', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$hab_ocupadas = ReservacionHab::find()->where(['reservacion' => $model->id])->andWhere(['estado' => 0])->all();
$hab = Habitacion::find()->orderBy('id ASC')->all();





$hab_dis = array();
$cont = 0;
$fecha_ent = $model->fecha_entrada;
$fecha_sal = $model->fecha_salida;

$fe_en = explode('-', $fecha_ent);
$model->fecha_entrada = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

$fe_sa = explode('-', $fecha_sal);
$model->fecha_salida = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

$fecha_ent = date('Y-m-d');

for ($i = 0; $i < count($hab); $i++) {

    $id_hab = $hab[$i]->id;

    $connection = \Yii::$app->db;
    $connection->open();

    $command = $connection->createCommand('SELECT reservacion.nombre_cliente FROM reservacion,reservacion_hab WHERE  (reservacion_hab.hab = :habitacion) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion.fecha_entrada <= :entrada1) AND (reservacion.fecha_salida > :salida1) AND (reservacion_hab.estado=0)  OR (reservacion.fecha_entrada <=:entrada2 ) AND (reservacion.fecha_salida >= :salida2) AND (reservacion.fecha_entrada > :entrada3 AND reservacion.fecha_entrada < :salida3) AND  (reservacion_hab.hab = :habitacion1)AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0) OR (reservacion.fecha_salida > :entrada4 AND reservacion.fecha_salida < :salida4) AND (reservacion_hab.hab = :habitacion2) AND (reservacion.id=reservacion_hab.reservacion) AND (reservacion_hab.estado=0)');
    $command->bindParam(':habitacion', $id_hab);
    $command->bindParam(':entrada1', $fecha_ent);
    $command->bindParam(':salida1', $fecha_ent);
    $command->bindParam(':entrada2', $fecha_sal);
    $command->bindParam(':salida2', $fecha_sal);
    $command->bindParam(':entrada3', $fecha_ent);
    $command->bindParam(':salida3', $fecha_sal);
    $command->bindParam(':habitacion1', $id_hab);
    $command->bindParam(':entrada4', $fecha_ent);
    $command->bindParam(':salida4', $fecha_sal);
    $command->bindParam(':habitacion2', $id_hab);
    $result = $command->queryAll();
    $connection->close();


    if (count($result) == 0) {
        $hab_dis[$cont] = array(
            'id' => $hab[$i]->id,
            'nombre' => $hab[$i]->nombre
        );
        $cont++;
    }
}

//print_r($fecha_sal);die;
?>

<?php
$form = ActiveForm::begin(['id' => 'form-signup',
            'method' => 'post',
            'action' => ['reservacion/addcambiar'],]);
?> 

<div class="pasadia-index">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">HAB OCUPADAS</h3>
                </div>
                <div class="panel-body">
                    <input type="text"  class="form-control hidden"  name="id_reserva"  value="<?php echo $model->id ?>" >

                    <div class="row">
                        <div class="col-md-6">
                            <b>Fecha de Entrada</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" id="reservacion-fecha_entrada" class="form-control" disabled="true" name="sal_cambiar" placeholder="Fecha Entrada" value="<?php echo $model->fecha_entrada ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" >
                            <b>Fecha de Salida</b>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                    <input data-toggle="cardloading" data-loading-effect="pulse" data-loading-color="amber" type="text" id="reservacion-fecha_salida" class="form-control" name="salcambiar" placeholder="Fecha Salida"  value="<?php echo $model->fecha_salida ?>">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <?php
                        for ($i = 0; $i < count($hab_ocupadas); $i++) {
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h2>
                                                    <?= $hab_ocupadas[$i]->hab0->nombre ?>
                                                </h2>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <div class="switch">
                                                    <label><input value="<?php echo $hab_ocupadas[$i]->id ?>"  name="<?= $hab_ocupadas[$i]->id ?>"  type="checkbox" checked="true"><span class="lever switch-col-indigo"></span></label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div id="<?php echo $hab_ocupadas[$i]->id . "body" ?>" class="body">
                                        <div>
                                            <input disabled="true" class="form-control" value="<?php echo $hab_ocupadas[$i]->ocupacion0->ocupacion0->nombre ?>">
                                        </div>
                                        <br>
                                        <div>
                                            <input type="text"  class="form-control"  placeholder="Precio"  name="<?= $hab_ocupadas[$i]->id . "ocupacionprecio" ?>" value="<?= $hab_ocupadas[$i]->precio ?>">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'CREAR' : 'CAMBIAR', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'height: 45px;margin-top:3.5em;;width: 100%']) ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">HAB DISPONIBLES</h3>
                </div>
                <div class="panel-body">
                    <?php
                    for ($k = 0; $k < count($hab); $k++) {
                        $bandera = 0;
                        for ($i = 0; $i < count($hab_dis); $i++) {
                            if ($hab[$k]->id == $hab_dis[$i]['id']) {
                                $bandera = 1;

                                break;
                            }
                        }
                        if ($bandera == 1) {
                            ?>
                            <div id="<?= $hab[$k]->id ?>card_habitacion" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h2>
                                                    <?= $hab[$k]->nombre ?>
                                                </h2>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <div class="switch">
                                                    <label><input value="<?php echo $hab[$k]->id ?>" data-hab="<?= $hab[$k]->id ?>" name="<?= $hab[$k]->id ?>" id="<?= $hab[$k]->id ?>" type="checkbox" "><span class="lever switch-col-indigo"></span></label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div id="<?php echo $hab[$k]->id . "body" ?>" class="body">
                                        <div id="<?= $hab[$k]->id ?>select_ocup_output">
                                            <input id="body" disabled="true" class="form-control" value="Ocupación">
                                        </div>
                                        <br>
                                        <div>
                                            <input type="text" id="<?= $hab[$k]->id . "ocupacionprecio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $hab[$k]->id . "ocupacionprecio" ?>">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div id="<?= $hab[$k]->id ?>card_habitacion" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h2>
                                                    <?= $hab[$k]->nombre ?>
                                                </h2>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <div class="switch">
                                                    <label><input value="<?php echo $hab[$k]->id ?>" data-hab="<?= $hab[$k]->id ?>" name="<?= $hab[$k]->id ?>" id="<?= $hab[$k]->id ?>" type="checkbox" ><span class="lever switch-col-indigo"></span></label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div id="<?php echo $hab[$k]->id . "body" ?>" class="body">
                                        <div id="<?= $hab[$k]->id ?>select_ocup_output">
                                            <input id="body" disabled="true" class="form-control" value="Ocupación">
                                        </div>
                                        <br>
                                        <div>
                                            <input type="text" id="<?= $hab[$k]->id . "ocupacionprecio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $hab[$k]->id . "ocupacionprecio" ?>">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>