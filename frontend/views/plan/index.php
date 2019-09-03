<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Plan;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'PLAN';
$this->params['breadcrumbs'][] = $this->title;
$plan = Plan::find()->all();
?>
<div class="pasadia-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">LISTADO DE PLANES</h3>
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
                    for ($i = 0; $i < count($plan); $i++) {
                        ?>
                        <tr>

                            <th><?php echo $plan[$i]->nombre ?></th>                            
                            <th>
                                <a href="<?= \Yii::$app->urlManager->createUrl(['plan/delete', 'id' => $plan[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el plan"><i class="fa fa-remove"></i></a>
                                <a href="<?= \Yii::$app->urlManager->createUrl(['plan/update', 'id' => $plan[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                            </th>

                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
