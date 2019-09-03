<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\User;
use frontend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'USUARIO';
$this->params['breadcrumbs'][] = $this->title;

$usuario = User::find()->all();
$asset = AppAsset::register($this);
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">LISTADO DE USUARIOS</h3>
    </div>
    <div class="panel-body">

        <p>
<?= Html::a('NUEVO', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


        <table  class="table table-striped table-bordered" id="notas">
            <thead class="bg-primary">
                <tr>
                    <th>NOMBRE Y APELLIDOS</th>
                    <th>USUARIOS</th>
                    <th><i class="fa fa-wrench"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($usuario); $i++) {
                    ?>
                    <tr>

                        <th><?php echo $usuario[$i]->nombre . ' ' . $usuario[$i]->apellidos ?></th>
                        <th><?php echo $usuario[$i]->username ?></th> 
                        <th>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['user/delete', 'id' => $usuario[$i]->id]); ?>" data-confirm="Estas seguro que deseas eliminar el usuario"><i class="fa fa-remove"></i></a>
                            <!--<a href="<?= \Yii::$app->urlManager->createUrl(['site/act_user', 'id' => $usuario[$i]->id]); ?>" ><i class="fa fa-edit"></i></a>-->
                        </th>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>


