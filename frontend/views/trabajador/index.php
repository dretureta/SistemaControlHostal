<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Trabajador;
use frontend\models\TrabFunciones;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TrabajadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TRABAJADOR';
$this->params['breadcrumbs'][] = $this->title;

$trab = Trabajador::find()->orderBy('nombre asc')->all();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE TRABAJADORES</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="agencia">
            <thead class="bg-primary">
                <tr>
                    <th>NOMBRE</th>
                    <th>DEPARTAMENTO</th>
                    <th>SALARIO EN EL MES</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($trab); $i++) {
                    $cont_trab = 0;
                    $fe = date('Y-m');
                    $func2 = TrabFunciones::find()->where(['trab' => $trab[$i]->id])->andwhere(['like', 'fecha', $fe])->all();
                    
                    for ($k = 0; $k < count($func2); $k++) {
                        $cont_trab+=$func2[$k]->precio * $func2[$k]->cantidad;
                    }
                   // print_r($cont_trab);die;
                    ?>
                    <tr>

                        <th><?php echo $trab[$i]->nombre ?></th>
                        <th><?php echo $trab[$i]->dpto0->nombre ?></th>
                        <th><?php echo Yii::$app->formatter->asDecimal($cont_trab, 2) ?></th>
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/delete', 'id' => $trab[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el trabajador"><i class="fa fa-remove"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/update', 'id' => $trab[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['trabajador/funciones', 'id' => $trab[$i]->id]); ?>" ><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add Funciones"></i></a>
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>
