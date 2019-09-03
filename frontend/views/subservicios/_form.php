<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Servicio;

/* @var $this yii\web\View */
/* @var $model frontend\models\Subservicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subservicios-form">
    <div id="respond">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-4">

                <b>Servicio</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">settings</i>
                    </span>
                    <div class="form-line">                           
                        <?php
                        $serv = ArrayHelper::map(Servicio::find()->all(), 'id', 'nombre');
                        echo $form->field($model, 'servicio')->dropDownList(
                                $serv, [
                            'prompt' => 'Seleccione un servicio',
                            'style' => 'height: 30px;margin-top:0.5em;;width: 100%',
                            'aria-required' => 'true'
                                ]
                        );
                        ?>                         
                    </div>
                </div>



            </div>
            <div class="col-md-4">
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

            <div class="col-md-4">
                <b>Ingles</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'ingles')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre']) ?>                            
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <b>Frances</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'frances')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre']) ?>                            
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <b>Precio</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">monetization_on</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'precio')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre']) ?>                            
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <br style="margin-top: 0.3em">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? ' ADICIONAR' : ' ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success fa fa-plus' : 'btn btn-primary fa fa-edit', 'style' => 'height:33px;width: 80%']) ?>
                </div>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>
