<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Gastos;
use frontend\models\Addgastos;
use frontend\models\Trabajador;
use frontend\models\TrabFunciones;
use frontend\models\Dpto;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GastosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'GASTOS';
$this->params['breadcrumbs'][] = $this->title;
$gastos = Gastos::find()->orderBy('nombre asc')->all();

$timezone = "America/Atikokan";
$dt = new datetime("now", new datetimezone($timezone));

$fecha =date("Y-m");

//$trab = Trabajador::find()->orderBy('nombre')->all();
//
//$cont_trab = 0;
//for ($i = 0; $i < count($trab); $i++) {    
//    $fe = date('Y-m');
//    $func2 = TrabFunciones::find()->where(['trab' => $trab[$i]->id])->andwhere(['like', 'fecha', $fe])->all();
//
//    for ($k = 0; $k < count($func2); $k++) {
//        $cont_trab+=$func2[$k]->precio * $func2[$k]->cantidad;
//    }
//}
?>
<?= Alert::widget() ?>
<div class="gastos-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">LISTADO DE GASTOS</h3>
        </div>
        <div class="panel-body">

            <p>
                <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <table  class="table table-striped table-bordered" id="gastos">
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 550px">DESCRIPCIÓN</th>                   
                        <th>CANTIDAD DE GASTOS</th>                   
                        <th>IMPORTES</th>                   
                        <th><i class="fa fa-wrench"> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($gastos); $i++) {
                        $g = Addgastos::find()->where(['gastos' => $gastos[$i]->id])->andwhere(['like', 'fecha', $fecha])->all();


                        $cant = count($g);
                        $imp = 0;

                        for ($k = 0; $k < count($g); $k++) {
                            $imp+= $g[$k]->importe;
                        }
                        ?>
                        <tr>

                            <th ><?php echo $gastos[$i]->nombre ?></th>
                            <th><?php echo $cant ?></th>
                            <th><?php echo Yii::$app->formatter->asDecimal($imp, 2) ?></th>
                            <th>
                                <?php
                                $dpto = Dpto::find()->where(['gastos' => $gastos[$i]->id])->all();
                                if (count($dpto) == 0) {
                                    ?>
                                    <a href="<?= \Yii::$app->urlManager->createUrl(['gastos/delete', 'id' => $gastos[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el gasto"><i class="fa fa-remove"></i></a>
                                    <a href="<?= \Yii::$app->urlManager->createUrl(['gastos/update', 'id' => $gastos[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                                    <a href="<?= \Yii::$app->urlManager->createUrl(['gastos/gastos', 'id' => $gastos[$i]->id]); ?>" ><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add Gastos"></i></a>
                                    <?php }
                                    ?>


                            </th>

                        </tr>
                    <?php }
                    ?>


                </tbody>
            </table>
        </div>
    </div>

</div>
