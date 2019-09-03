<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Ocupacion;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OcupacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OCUPACIÓN';
$this->params['breadcrumbs'][] = $this->title;
$ocupacion=  Ocupacion::find()->orderBy('id asc')->all();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE OCUPACIÓN</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="ocupacion">
            <thead class="bg-primary">
                <tr>
                    <th>DESCRIPCIÓN</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($ocupacion); $i++) {
                    ?>
                    <tr>

                        <th><?php echo $ocupacion[$i]->nombre ?></th>
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['ocupacion/delete', 'id' => $ocupacion[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar la ocupación"><i class="fa fa-remove"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['ocupacion/update', 'id' => $ocupacion[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                           
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>
