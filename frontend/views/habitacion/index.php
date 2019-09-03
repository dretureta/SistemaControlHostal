<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Habitacion;
use frontend\models\OcupacionHab;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\HabitacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'HABITACÓN';
$this->params['breadcrumbs'][] = $this->title;
$hab=  Habitacion::find()->where(['codigo' => 0])->orderBy('nombre ASC')->all();

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE HABITACIÓN</h3>
    </div>
    <div class="panel-body">

        <p>
            <?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="hab">
            <thead class="bg-primary">
                <tr>
                    <th>DESCRIPCIÓN</th>
                    <th>OCUPACIÓN</th> 
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($hab); $i++) {
                    ?>
                    <tr>

                        <th><?php echo $hab[$i]->nombre ?></th>                       
                        <th><?php 
                            $ocu=OcupacionHab::find()->where(['hab'=>$hab[$i]->id])->all();
                            
                            for ($k = 0; $k < count($ocu); $k++) {
                                if ($k < count($ocu)-1) {
                                   echo " ".$ocu[$k]->ocupacion0->nombre.',   '  ; 
                                }  else {
                                    echo " ".$ocu[$k]->ocupacion0->nombre.'  '  ;
                                }
                                                             
                            }
                        ?></th>                       
                        
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['habitacion/delete', 'id' => $hab[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar la habitación"><i class="fa fa-remove"></i></a>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['habitacion/update', 'id' => $hab[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>
                           
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>
