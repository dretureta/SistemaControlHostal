<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Funciones */
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
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">monetization_on</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'precio')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Precio']) ?>                            
                    </div>
                </div>    
            </div>
            <!--            <div class="col-md-1">
                            <b>No incluir Habitación</b>
                            <div class="col-md-4 text-right" style="margin-top: 1.5em">
                                <div class="switch">
                                    <label><input value="1" name="pago" id="pago" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                </div>
                            </div>
            
                        </div>-->
            <div class="col-md-2" style="margin-top: 1em">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? ' ADICIONAR' : ' ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success fa fa-plus' : 'btn btn-primary fa fa-edit', 'style' => 'height:33px;width: 80%']) ?>
                </div>
            </div>
        </div>





        <?php ActiveForm::end(); ?>

    </div>

</div>
