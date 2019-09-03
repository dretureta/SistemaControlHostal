<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Subservicios;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SubserviciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SUB SERVICIO';
$this->params['breadcrumbs'][] = $this->title;
$serv=  Subservicios::find()->all();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE SUB SERVICIOS</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="subservicios">
            <thead class="bg-primary">
                <tr>
                    <th>SERVICIO</th>
                    <th>SUB SERVICIO</th>
                    <th>PRECIO</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($serv); $i++) {
                    ?>
                    <tr>

                        <th><?php echo $serv[$i]->servicio0->nombre ?></th>
                        <th><?php echo $serv[$i]->nombre ?></th>
                        <th><?php echo $serv[$i]->precio ?></th>
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['subservicios/delete', 'id' => $serv[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el subservicio"><i class="fa fa-remove"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['subservicios/update', 'id' => $serv[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                           
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>
