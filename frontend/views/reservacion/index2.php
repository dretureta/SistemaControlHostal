<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Reservacion;
use frontend\models\ReservacionHab;
use frontend\models\ReservacionesDenegadas;
use frontend\models\Auxiliar;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReservacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RESERVACIONES';
$this->params['breadcrumbs'][] = $this->title;


$fe = date('Y-m-d');

$fecha_term = date('Y') . "-" . date('m');

$reservacion = Reservacion::find()->where(['estado' => 0])->orderBy("fecha_entrada,nombre_cliente ASC")->all();

$activas = Reservacion::find()->where(['estado' => 1])->orderBy("fecha_entrada,nombre_cliente ASC")->all();




$mod_date1 = strtotime($fecha_term . "- 1 month");
$fe_terminada = date("Y-m", $mod_date1);


$terminadas = Reservacion::find()
        ->where(['estado' => 2])
        ->andWhere(['like', 'fecha_entrada', $fecha_term])
        ->orWhere(['like', 'fecha_entrada', $fe_terminada])
        ->orderBy("fecha_entrada desc")
        ->all();




$denegadas = ReservacionesDenegadas::find()->orderBy('fecha_entrada,fecha_solicitud asc')->all();

$liberadas = Auxiliar::find()->orderBy('fecha_entrada desc')->all();





$timezone = "America/Atikokan";
$dt = new datetime("now", new datetimezone($timezone));

$fe = gmdate("Y-m-d", (time() + $dt->getOffset()));

//print_r($fe);die;
?>





<!--Horizontal Tab-->
<div id="horizontalTab">
    <ul>
        <li><a href="#tab-1">RESERVAS ACTIVAS (<?php echo count($activas) ?>)</a></li>
        <li><a href="#tab-2">RESERVAS PREVIAS (<?php echo count($reservacion) ?>)</a></li>
        <li><a href="#tab-3">RESERVAS DENEGADAS (<?php echo count($denegadas) ?>)</a></li>
        <li><a href="#tab-4">RESERVAS LIBERADAS(<?php echo count($liberadas) ?>)</a></li>
        <li><a href="#tab-5">RESERVAS TERMINADAS(<?php echo count($terminadas) ?>)</a></li>
    </ul>

    <div id="tab-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> ACTIVAS</h3>
            </div>
            <div class="panel-body">
                <div class="agencia-create">
                    <table  class="table table-striped table-bordered" id="activas">

                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center" width="220px">NOMBRE CLIENTE</th>
                                <th class="text-center">FECHA ENTRADA</th>
                                <th class="text-center">FECHA SALIDA</th>
                                <th class="text-center" width="40px">HABITACIÓN</th>
                                <th class="text-center" width="160px">AGENCIA</th>
                                <th class="text-center" width="30px">PLAN</th>
                                <th class="text-center" width="180px">OBSERVACIONES</th>
                                <th class="text-center">OPCIONES  </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//print_r($activas);die;

                            for ($i = 0; $i < count($activas); $i++) {
                                $ha_activas = ReservacionHab::find()->where(['reservacion' => $activas[$i]->id])->andWhere(['estado' => 0])->orderBy("hab asc")->all();
                                //print_r($ha_activas);die;
                                $fe_en = explode('-', $ha_activas[0]->fecha_entrada);
                                $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

                                $fe_sa = explode('-', $ha_activas[0]->fecha_salida);
                                $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];
                                ?>
                                <tr >

                                    <th class="text-center"><?php echo $activas[$i]->nombre_cliente ?></th>
                                    <th class="text-center"><?php echo $fecha_ent ?></th>
                                    <th class="text-center"><?php echo $fecha_sal ?></th>
                                    <th class="text-center"><?php
                                        for ($k = 0; $k < count($ha_activas); $k++) {

                                            if ($k == count($ha_activas) - 1) {
                                                echo $ha_activas[$k]->hab0->nombre;
                                            } else {
                                                echo $ha_activas[$k]->hab0->nombre . ', ';
                                            }
                                        }
                                        ?></th>

                                    <th class="text-center"><?php echo $activas[$i]->agencia0->nombre ?></th>
                                    <th class="text-center"><?php echo $activas[$i]->plan0->nombre ?></th>
                                    <th class="text-center"><?php echo $activas[$i]->obs ?></th>
                                    <th>
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/delete', 'id' => $activas[$i]->id ,'tab'=>0]); ?>" data-confirm="Estas seguro que deseas eliminar la reservación"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a> 
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/cambiar', 'id' => $activas[$i]->id]); ?> " ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/servicio', 'id' => $activas[$i]->id]); ?>" ><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add Servicio"></i></a>
                                        
                                    </th>

                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="tab-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> PREVIAS</h3>
            </div>
            <div class="panel-body">
                <div class="agencia-create">
                    <p>
                        <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <table  class="table table-striped table-bordered" id="pendientes" >
                        <thead class="bg-primary">
                            <tr>
                                <th width="150px" class="text-center" >NOMBRE CLIENTE</th>
                                <th class="text-center">FECHA ENTRADA</th>
                                <th class="text-center">FECHA SALIDA</th>
                                <th width="50px" class="text-center">HABITACIÓN</th>
                                <th class="text-center" width="100px">AGENCIA</th>
                                <th class="text-center">PLAN</th>
                                <th width="150px" class="text-center">OBSERVACIONES</th>
                                <th width="45px" class="text-center"> OPCIONES </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($reservacion); $i++) {
                                $ha_pend = ReservacionHab::find()->where(['reservacion' => $reservacion[$i]->id])->orderBy("id asc")->all();
                                $fe_en = explode('-', $reservacion[$i]->fecha_entrada);
                                $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

                                $fe_sa = explode('-', $reservacion[$i]->fecha_salida);
                                $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];
                                ?>
                                <tr >
                                    <th class="text-center"><?php echo $reservacion[$i]->nombre_cliente ?></th>
                                    <th class="text-center"><?php echo $fecha_ent ?></th>
                                    <th class="text-center"><?php echo $fecha_sal ?></th>
                                    <th class="text-center"><?php
                                        for ($k = 0; $k < count($ha_pend); $k++) {
                                            if ($k == count($ha_pend) - 1) {
                                                echo $ha_pend[$k]->hab0->nombre;
                                            } else {
                                                echo $ha_pend[$k]->hab0->nombre . ', ';
                                            }
                                        }
                                        ?></th>
                                    <th class="text-center" width="100px"><?php echo $reservacion[$i]->agencia0->nombre ?></th>
                                    <th class="text-center"><?php echo $reservacion[$i]->plan0->nombre ?></th>
                                    <th class="text-center"><?php echo $reservacion[$i]->obs ?></th>
                                    <th>
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/delete', 'id' => $reservacion[$i]->id ,'tab'=>1]); ?>" data-confirm="Estas seguro que deseas eliminar la reservación"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a> <?php echo " " ?>          
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/update', 'id' => $reservacion[$i]->id]); ?>" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/servicio', 'id' => $reservacion[$i]->id]); ?>" ><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add Servicio"></i></a>
                                        <?php if ($fe >= $ha_pend[0]->fecha_entrada) { ?>

                                            <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/activa', 'id' => $reservacion[$i]->id]); ?>" data-confirm="Estas seguro que deseas activar la reservación"><i class="fa fa-adn" data-toggle="tooltip" data-placement="top" title="Activar Reserva"></i></a>
                                        <?php }
                                        ?>

                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/quitar', 'id' => $reservacion[$i]->id]); ?>" data-confirm="Estas seguro que deseas quitar la reservación"><i class="fa fa-share" data-toggle="tooltip" data-placement="top" title="Liberar" ></i></a>
                                    </th>

                                </tr>


                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div id="tab-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> DENEGADAS</h3>
            </div>
            <div class="panel-body">
                <div class="agencia-create">
                    <p >

                        <?= Html::a('NUEVO', ['denegadas'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <table  class="table table-striped table-bordered" id="denegadas">
                        <thead class="bg-primary">
                            <tr>
                                <th width="220px">NOMBRE CLIENTE</th>
                                <th width="120px">FECHA SOLICITUD</th>
                                <th width="120px">FECHA ENTRADA</th>
                                <th>FECHA SALIDA</th>
                                <th>SGL</th>
                                <th>DBL</th>
                                <th>TRI</th>
                                <th>AGENCIA</th>
                                <th>OBSERVACIONES</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $denegadas = ReservacionesDenegadas::find()->orderBy('fecha_entrada,fecha_solicitud asc')->all();
                            for ($i = 0; $i < count($denegadas); $i++) {

                                $fe_en = explode('-', $denegadas[$i]->fecha_entrada);
                                $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

                                $fe_sa = explode('-', $denegadas[$i]->fecha_salida);
                                $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

                                $fe_sol = explode('-', $denegadas[$i]->fecha_solicitud);
                                $fecha_sol = $fe_sol[2] . '-' . $fe_sol[1] . '-' . $fe_sol[0];
                                ?>
                                <tr>
                                    <th><?php echo $denegadas[$i]->nombre_cliente ?></th>
                                    <th><?php echo $fecha_sol ?></th>
                                    <th><?php echo $fecha_ent ?></th>
                                    <th><?php echo $fecha_sal ?></th>
                                    <th><?php echo $denegadas[$i]->simple ?></th>
                                    <th><?php echo $denegadas[$i]->doble ?></th>
                                    <th><?php echo $denegadas[$i]->triple ?></th>
                                    <th><?php echo $denegadas[$i]->agencia0->nombre ?></th>
                                    <th><?php echo $denegadas[$i]->obs ?></th>
                                    <th>
                                        
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/deldenegadas', 'id' => $denegadas[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar la reservación"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/actdenegadas', 'id' => $denegadas[$i]->id]); ?>" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>  
                                        

                                    </th>

                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="tab-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> LIBERADAS</h3>
            </div>
            <div class="panel-body">
                <div class="agencia-create">
                    <table  class="table table-striped table-bordered" id="liberadas">

                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">NOMBRE CLIENTE</th>
                                <th class="text-center">FECHA ENTRADA</th>
                                <th class="text-center">FECHA SALIDA</th>
                                <th class="text-center">AGENCIA</th>
                                <th class="text-center">OBSERVACIONES</th>
                                <th class="text-center">OPCIONES  </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($liberadas); $i++) {

                                $fe_en = explode('-', $liberadas[$i]->fecha_entrada);
                                $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

                                $fe_sa = explode('-', $liberadas[$i]->fecha_salida);
                                $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];
                                ?>
                                <tr >

                                    <th class="text-center"><?php echo $liberadas[$i]->nombre ?></th>
                                    <th class="text-center"><?php echo $fecha_ent ?></th>
                                    <th class="text-center"><?php echo $fecha_sal ?></th>
                                    <th class="text-center"><?php echo $liberadas[$i]->agencia0->nombre ?></th>
                                    <th class="text-center"><?php echo $liberadas[$i]->obs ?></th>
                                    <th>
                                        <a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/create', 'id' => $liberadas[$i]->id]); ?> " data-confirm="Estas seguro que deseas crear la reservación"><i class="fa fa-adn" data-toggle="tooltip" data-placement="top" title="Reservar"></i></a>


                                    </th>

                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="tab-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> TERMINADAS</h3>
            </div>
            <div class="panel-body">
                <div class="agencia-create">
                    <table  class="table table-striped table-bordered" id="terminadas">

                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">NOMBRE CLIENTE</th>
                                <th class="text-center">FECHA ENTRADA</th>
                                <th class="text-center">FECHA SALIDA</th>
                                <th class="text-center">AGENCIA</th>
                                <th class="text-center">OBSERVACIONES</th>
                                <th class="text-center">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($terminadas); $i++) {

                                $fe_en = explode('-', $terminadas[$i]->fecha_entrada);
                                $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];

                                $fe_sa = explode('-', $terminadas[$i]->fecha_salida);
                                $fecha_sal = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];
                                ?>
                                <tr >

                                    <th class="text-center"><?php echo $terminadas[$i]->nombre_cliente ?></th>
                                    <th class="text-center"><?php echo $fecha_ent ?></th>
                                    <th class="text-center"><?php echo $fecha_sal ?></th>
                                    <th class="text-center"><?php echo $terminadas[$i]->agencia0->nombre ?></th>
                                    <th class="text-center"><?php echo $terminadas[$i]->obs ?></th>
                                    <th class="text-center"><a href="<?= \Yii::$app->urlManager->createUrl(['reservacion/terminada', 'id' => $terminadas[$i]->id]); ?>" > VER  FACTURA </a></th>


                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
if (isset($_GET['tab'])) {
    $tab = Yii::$app->request->get('tab');
    if ($tab == 0) {
        $script = "$('#horizontalTab').responsiveTabs('activate', 0);";
        $this->registerJs($script, View::POS_READY);
    }
    if ($tab == 1) {
        $script = "$('#horizontalTab').responsiveTabs('activate', 1);";
        $this->registerJs($script, View::POS_READY);
    }
    if ($tab == 2) {
        $script = "$('#horizontalTab').responsiveTabs('activate', 2);";
        $this->registerJs($script, View::POS_READY);
    }
    if ($tab == 3) {
        $script = "$('#horizontalTab').responsiveTabs('activate', 3);";
        $this->registerJs($script, View::POS_READY);
    }
    if ($tab == 4) {
        $script = "$('#horizontalTab').responsiveTabs('activate', 4);";
        $this->registerJs($script, View::POS_READY);
    }
}
?>


