<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Funciones;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FuncionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FUNCIONES';
$this->params['breadcrumbs'][] = $this->title;

$func= Funciones::find()->orderBy('nombre asc')->all();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE FUNCIONES</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="agencia">
            <thead class="bg-primary">
                <tr>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($func); $i++) {
                    ?>
                    <tr>

                        <th><?php echo $func[$i]->nombre ?></th>
                        <th><?php echo $func[$i]->precio ?></th>
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['funciones/delete', 'id' => $func[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar la función"><i class="fa fa-remove"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['funciones/update', 'id' => $func[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                           
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>
