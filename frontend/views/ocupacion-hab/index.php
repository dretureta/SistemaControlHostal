<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\OcupacionHab;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OcupacionHabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OCUPACIÓN HAB';
$this->params['breadcrumbs'][] = $this->title;
$serv=  OcupacionHab::find()->all();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE OCUPACIÓN HAB</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="ocu_hab">
            <thead class="bg-primary">
                <tr>
                    <th>OCUPACIÓN</th>
                    <th>HABITACIÓN</th>
                    <th>PRECIO</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($serv); $i++) {
                    ?>
                    <tr>

                        <th><?php echo $serv[$i]->ocupacion0->nombre ?></th>
                        <th><?php echo $serv[$i]->hab0->nombre ?></th>
                        <th><?php echo $serv[$i]->precio ?></th>
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['ocupacion-hab/delete', 'id' => $serv[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el servicio"><i class="fa fa-remove"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['ocupacion-hab/update', 'id' => $serv[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                           
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>
