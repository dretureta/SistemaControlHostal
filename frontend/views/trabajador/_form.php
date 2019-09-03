<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Dpto;
/* @var $this yii\web\View */
/* @var $model frontend\models\Trabajador */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="agencia-form">

    <div id="respond">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-7">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre']) ?>                            
                    </div>
                </div>    
            </div>
            
            <div class="col-md-3">
                <div class="input-group" style="margin-top: 0.7em">
                    <span class="input-group-addon">
                        <i class="material-icons">settings</i>
                    </span>
                                              
                        <?php
                        $serv = ArrayHelper::map(Dpto::find()->orderBy("nombre")->all(), 'id', 'nombre');
                        echo $form->field($model, 'dpto')->dropDownList(
                                $serv, [
                            'prompt' => 'Seleccione un departamento',
                            'style' => 'height: 30px;margin-top:0.5em;;width: 100%',
                            'aria-required' => 'true'
                                ]
                        );
                        ?> 
                </div>



            </div>

            <div class="col-md-2">
                <div class="form-group" style="margin-top: 1.5em">
                    <?= Html::submitButton($model->isNewRecord ? ' ADICIONAR' : ' ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success fa fa-plus' : 'btn btn-primary fa fa-edit', 'style' => 'height:33px;width: 80%']) ?>
                </div>
            </div>
        </div>





        <?php ActiveForm::end(); ?>

    </div>

</div>


