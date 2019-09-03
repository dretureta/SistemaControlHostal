<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Agencia;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AgenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AGENCIA';
$this->params['breadcrumbs'][] = $this->title;

$agencia=  Agencia::find()->orderBy('nombre asc')->all();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE AGENCIA</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="agencia">
            <thead class="bg-primary">
                <tr>
                    <th>DESCRIPCIÓN</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($agencia); $i++) {
                    ?>
                    <tr>

                        <th><?php echo $agencia[$i]->nombre ?></th>
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['agencia/delete', 'id' => $agencia[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar la agencia"><i class="fa fa-remove"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['agencia/update', 'id' => $agencia[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                           
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>





