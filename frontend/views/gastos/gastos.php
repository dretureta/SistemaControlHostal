<?php

use yii\helpers\Html;
use frontend\models\Addgastos;
use frontend\models\Gastos;
use frontend\models\Unidad;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'ADICIONAR GASTOS';
$this->params['breadcrumbs'][] = ['label' => 'GASTOS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$id = Yii::$app->request->get('id');

$fecha = '20' . date('y') . '-' . date('m');



$timezone = "America/Atikokan";

$dt = new datetime("now", new datetimezone($timezone));

//echo "Fecha de la Zona horaria: " . gmdate("Y/m/d", (time() + $dt->getOffset()));
//print_r(DateTimeZone::listIdentifiers());



$gastos = Addgastos::find()->where(['gastos' => $id])->andwhere(['like', 'fecha', $fecha])->orderBy('fecha desc')->all();
$add = new Addgastos();
$gas = Gastos::findAll(['id' => $id]);
?>

<div class="row">
    <div class="col-md-6">


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-plus"></i> ADICIONAR GASTOS </h3>
            </div>
            <div class="panel-body">

                <?php
                $form = ActiveForm::begin(['id' => 'form-signup',
                            'method' => 'post',
                            'action' => ['gastos/adicionar']]);
                ?> 
                <div class="row">
                    <div class="col-md-12 hidden"> 
                        <?= $form->field($add, 'gastos')->textInput(['maxlength' => true, 'class' => 'form-control', 'value' => $id]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">              
                        <b>Cantidad</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <div class="form-line">                           
                                <?= $form->field($add, 'cant')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Cantidad', 'reuired' => 'required']) ?>                            
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <b>Unidad</b>


                        <div class="form-line">
                            <?php
                            $hab = ArrayHelper::map(Unidad::find()->orderBy('nombre asc')->all(), 'id', 'nombre');
                            echo $form->field($add, 'unidad')->dropDownList(
                                    $hab, [
                                'prompt' => 'Seleccione una unidad',
                                'aria-required' => 'true',
                                'reuired' => 'required',
                                'id' => 'add_gastos'
                                    ]
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" >
                        <b>Importe</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">monetization_on</i>
                            </span>
                            <div class="form-line">                           
                                <?= $form->field($add, 'importe')->textInput(['maxlength' => true, 'class' => 'form-control ', 'aria-required' => 'true', 'placeholder' => 'Importe']) ?>                            
                            </div>
                        </div>
                    </div>




                    <div class="col-md-6">
                        <b>Fecha de Compra</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">                                    
                                <?= $form->field($add, 'fecha')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Fecha', 'id' => 'fechagastos', 'style' => 'margin-top: -0.1em', 'value' => gmdate("d-m-Y", (time() + $dt->getOffset()))]) ?>                            
                            </div>
                        </div>                    
                    </div>

                    <div class="col-md-4">  
                        <button class="btn-success" style= 'width: 90%' ><i class="fa fa-plus">  </i> ADICIONAR</button>  
                    </div>
                    <div class="col-md-2">
                        
                    </div>
                    <div class="col-md-4" style="margin-top: 1em">
                        <a href="<?= \Yii::$app->urlManager->createUrl(['gastos/index', 'style' => 'height: 40px;width: 100%;']); ?>" class="btn btn-danger text-center" style="height: 36px;width: 85%"><i class="fa fa-arrow-circle-left">  </i><b> TERMINAR</b></a>
                        
                    </div> 

                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div> 
    </div>


    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> LISTADO GASTOS DE: <?php echo $gas[0]->nombre ?> </h3>
            </div>
            <div class="panel-body">    



                <div class="inner_table">

                </div>
                <table  class="table table-striped table-bordered" id="addgastos3">
                    <thead class="bg-primary">
                        <tr>   
                            <th>FECHA</i></th>
                            <th>CANT</th>
                            <th>U/M</th>
                            <th>IMPORTE</i></th>
                            <th><i class="fa fa-wrench"> </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sum_imp = 0;
                        $sum_cant = 0;

                        for ($i = 0; $i < count($gastos); $i++) {

                            $sum_imp+=$gastos[$i]->importe;

                            $fe_en = explode('-', $gastos[$i]['fecha']);
                            $fecha_ent = $fe_en[2] . '-' . $fe_en[1] . '-' . $fe_en[0];
                            ?>
                            <tr>      
                                <th><?php echo $fecha_ent ?></th>
                                <th> <?php echo Yii::$app->formatter->asDecimal($gastos[$i]['cant'], 2) ?></th>
                                <th> <?php echo $gastos[$i]->unidad0->nombre ?></th>
                                <th><?php echo Yii::$app->formatter->asDecimal($gastos[$i]['importe'], 2) ?></th>
                                <th> <a href="<?= \Yii::$app->urlManager->createUrl(['gastos/deleteaddgas', 'gas' => $gastos[$i]->id, 'id' => $gastos[$i]->gastos]); ?>" data-confirm="Estas seguro que deseas eliminar el gasto"><i class="fa fa-remove"></i></a></th>
                            </tr>
                        <?php }
                        ?>



                        <tr>    
                            <th> </th>  
                            <th> </th> 
                            <th>TOTAL</th>
                            <th> <?php echo Yii::$app->formatter->asDecimal($sum_imp, 2) ?></th>
                            <th> </th> 
                        </tr>

                    </tbody>
                </table>






            </div>

        </div>
    </div>
</div>







