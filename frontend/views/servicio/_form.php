<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Servicio;
/* @var $this yii\web\View */
/* @var $model frontend\models\Servicio */
/* @var $form yii\widgets\ActiveForm */
$lis_servicio = Servicio::find()->orderBy('prioridad desc')->all();
$num =  $lis_servicio[0]->prioridad + 1;
?>
<!DOCTYPE html>
<div class="servicio-form">
    <div id="respond">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <b>Nombre</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre']) ?>                            
                    </div>
                </div>    
            </div>
            <div class="col-md-6">
                <b>Ingles</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'ingles')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Ingles']) ?>                            
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
                        <?= $form->field($model, 'frances')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Frances']) ?>                            
                    </div>
                </div>    
            </div>
            <div class="col-md-3">
                <b>Prioridad</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'prioridad')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Prioridad','value' => $num]) ?>                            
                    </div>
                </div>    
            </div>
            
            <div class="col-md-2" style="margin-top: 1em">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? ' ADICIONAR' : ' ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success fa fa-plus' : 'btn btn-primary fa fa-edit', 'style' => 'height:33px;width: 80%']) ?>
                </div>
            </div>            
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>


