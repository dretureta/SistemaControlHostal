<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Plan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row clearfix">

        <div class="col-md-10">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">face</i>
                </span>
                <div class="form-line">                           
                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre']) ?>                            
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
