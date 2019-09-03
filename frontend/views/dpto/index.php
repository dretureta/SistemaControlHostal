<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Dpto;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DptoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'DEPARTAMENTO';
$this->params['breadcrumbs'][] = $this->title;

$dpto= Dpto::find()->orderBy('nombre asc')->all();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE DEPARTAMENTO</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="agencia">
            <thead class="bg-primary">
                <tr>
                    <th>NOMBRE</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($dpto); $i++) {
                    ?>
                    <tr>

                        <th><?php echo $dpto[$i]->nombre ?></th>
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['dpto/delete', 'id' => $dpto[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el departamento, se eliminará el gasto"><i class="fa fa-remove"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['dpto/update', 'id' => $dpto[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                           
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>
