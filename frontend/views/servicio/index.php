<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Servicio;
use frontend\models\Subservicios;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ServicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SERVICIOS';
$this->params['breadcrumbs'][] = $this->title;
$serv=  Servicio::find()->where([ 'estado' => 0])->orderBy('prioridad asc')->all();
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE SERVICIOS</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="servicio">
            <thead class="bg-primary">
                <tr>
                    <th>SERVICIO</th>
                    <th>INGLES</th>
                    <th>FRANCES</th>
                    <th>PRIORIDAD</th>
                    <th>SUBSERVICIOS</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($serv); $i++) {
                    $cant=  count(Subservicios::find()->where(['servicio'=>$serv[$i]->id])->andwhere(['estado'=>0])->all());
                    ?>
                    <tr>

                        <th><?php echo $serv[$i]->nombre ?></th>
                        <th><?php echo $serv[$i]->ingles ?></th>
                        <th><?php echo $serv[$i]->frances ?></th>
                        <th><?php echo $serv[$i]->prioridad ?></th>
                        <th><?php echo $cant ?></th>
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['servicio/delete', 'id' => $serv[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el servicio"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Eliminar Servicios"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['servicio/update', 'id' => $serv[$i]->id]); ?>" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar Servicios"></i></a>

                           <a href="<?= \Yii::$app->urlManager->createUrl(['servicio/sub', 'id' => $serv[$i]->id]); ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Adicionar Subservicios"></i></a>
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>



