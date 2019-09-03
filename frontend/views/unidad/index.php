<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Unidad;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UnidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'UNIDAD';
$this->params['breadcrumbs'][] = $this->title;
$unidad = Unidad::find()->orderBy("nombre ASC")->all();
?>
<div class="pasadia-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">LISTADO DE UNIDADES</h3>
        </div>
        <div class="panel-body">

            <p>
                <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <table  class="table table-striped table-bordered" id="pdia">
                <thead class="bg-primary">
                    <tr>
                        <th>DESCRIPCIÓN</th>             
                        <th><i class="fa fa-wrench"> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($unidad); $i++) {
                        ?>
                        <tr>

                            <th><?php echo $unidad[$i]->nombre ?></th>                            
                            <th>
                                <a href="<?= \Yii::$app->urlManager->createUrl(['unidad/delete', 'id' => $unidad[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar la unidad"><i class="fa fa-remove"></i></a>
                                <a href="<?= \Yii::$app->urlManager->createUrl(['unidad/update', 'id' => $unidad[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                            </th>

                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
