<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Pasadia;
use frontend\models\PasadiaServicio;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PasadiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'PASADIA';
$this->params['breadcrumbs'][] = $this->title;

$fecha = date("Y") . "-" . date("m");
$mod_date1 = strtotime($fecha . "+ 1 month");
$fe = date("Y-m", $mod_date1);


$pdia = Pasadia::find()
        ->where(['estado' => 0])
        ->andWhere(['like', 'fecha', $fecha])
        ->orWhere(['like', 'fecha', $fe])
        ->orderBy('fecha desc')
        ->all();
?>
<div class="pasadia-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">LISTADO DE PASADIAS</h3>
        </div>
        <div class="panel-body">

            <p>
                <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <table  class="table table-striped table-bordered" id="pdia">
                <thead class="bg-primary">
                    <tr>
                        <th class="">NOMBRE CLIENTE</th>                   
                        <th class="text-center">IMPORTE TOTAL</th>                   
                        <th class="text-center">FECHA</th>                   
                        <th class="text-center">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   
                    for ($i = 0; $i < count($pdia); $i++) {
                         $sunm=0;
                        $servi= PasadiaServicio::find()->where(['pasadia'=>$pdia[$i]->id])->andWhere(['incluir'=>0])->all();
                        for ($k = 0; $k < count($servi); $k++) {
                            $sunm+=$servi[$k]->cant*$servi[$k]->precio;                            
                        }
                        ?>
                        <tr>

                            <th class=""><?php echo $pdia[$i]->nombre ?></th>
                            <th class="text-center"><?php echo "(".$sunm." CUC)"?></th>
                            <th class="text-center"><?php
                                $fe = explode('-', $pdia[$i]->fecha);
                                $pdia[$i]->fecha = $fe[2] . '-' . $fe[1] . '-' . $fe[0];

                                echo $pdia[$i]->fecha
                                ?></th>
                            <th class="text-center">
                                <a href="<?= \Yii::$app->urlManager->createUrl(['pasadia/delete', 'id' => $pdia[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el pasadia"><i class="fa fa-remove"></i></a>
                                <a href="<?= \Yii::$app->urlManager->createUrl(['pasadia/update', 'id' => $pdia[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                                <a href="<?= \Yii::$app->urlManager->createUrl(['pasadia/servicio', 'id' => $pdia[$i]->id]); ?>" ><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add Servicios"></i></a>

                            </th>

                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
