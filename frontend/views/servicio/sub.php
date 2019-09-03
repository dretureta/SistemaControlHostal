<?php

use yii\helpers\Html;
use frontend\models\Subservicios;
use yii\widgets\ActiveForm;

$this->title = 'ADICIONAR SUBSERVICIOS';
$this->params['breadcrumbs'][] = ['label' => 'SERVICIOS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$serv = Subservicios::find()->where(['servicio' => $id->id])->andwhere(['estado' => 0])->orderBy('nombre asc')->all();
$add = new Subservicios();
?>

<div class="row">
    <div class="col-md-6">


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-plus"></i> ADICIONAR SUBSERVICIOS </h3>
            </div>
            <div class="panel-body">

                <?php
                $form = ActiveForm::begin(['id' => 'form-signup',
                            'method' => 'post',
                            'action' => ['servicio/add']]);
                ?> 
                <div class="row">
                    <div class="col-md-12 hidden"> 
                        <?= $form->field($add, 'servicio')->textInput(['maxlength' => true, 'class' => 'form-control', 'value' => $id->id]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">              
                        <b>Nombre</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">                           
                                <?= $form->field($add, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre']) ?>                            
                            </div>
                        </div> 
                    </div>


                    <div class="col-md-6" >
                        <b>Ingles</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">                           
                                <?= $form->field($add, 'ingles')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Ingles']) ?>                            
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">              
                        <b>Frances</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">                           
                                <?= $form->field($add, 'frances')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Frances']) ?>                            
                            </div>
                        </div> 
                    </div>


                    <div class="col-md-6" >
                        <b>Precio</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">                           
                                <?= $form->field($add, 'precio')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Precio']) ?>                            
                            </div>
                        </div>
                    </div>

                </div>

                

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button class="btn-success" style= 'height:32px;width: 60%'><i class="fa fa-plus">  </i> ADICIONAR</button>
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-top: 0.8em">
                        <a href="<?= \Yii::$app->urlManager->createUrl(['servicio/index']); ?>" class="btn btn-danger text-center" style="height: 35px;width: 60%"><i class="fa fa-arrow-circle-left">  </i><b> TERMINAR</b></a>

                    </div>

                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div> 
    </div>


    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> LISTADO SUBSERVICIOS DE: <?php echo $id->nombre ?> </h3>
            </div>
            <div class="panel-body">                
                <table  class="table table-striped table-bordered" id="sub">
                    <thead class="bg-primary">
                        <tr>   
                            <th>NOMBRE</th>
                            <th>PRECIO</i></th>
                            <th><i class="fa fa-wrench"> </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        for ($i = 0; $i < count($serv); $i++) {
                            ?>
                            <tr> 
                                <th> <?php echo $serv[$i]->nombre ?></th>
                                <th><?php echo $serv[$i]->precio ?></th>
                                <th>
                                    <a href="<?= \Yii::$app->urlManager->createUrl(['servicio/delete_sub', 'id' => $serv[$i]->id, 'serv' => $id->id]); ?>" data-confirm="Estas seguro que deseas eliminar el servicio"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Eliminar Subservicio"></i></a>
                                    <a href="<?= \Yii::$app->urlManager->createUrl(['subservicios/update', 'id' => $serv[$i]->id]); ?>" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar Servicios"></i></a>
                                </th>

                            </tr>
                        <?php }
                        ?>


                    </tbody>
                </table>



            </div>

        </div>
    </div>
</div>
