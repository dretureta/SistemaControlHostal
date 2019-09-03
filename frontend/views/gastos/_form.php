<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Gastos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-form">
    <div id="respond">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">            

            <div class="col-md-8">
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



            <div class="col-md-2" style="margin-top: 1em">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? ' ADICIONAR' : ' ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success fa fa-plus' : 'btn btn-primary fa fa-edit', 'style' => 'height:33px;width: 80%;font-family: FontAwesome;font-size: 12px']) ?>
                </div>
            </div>

            <div class="col-md-2" style="margin-top: 1.7em;">
                <a href="<?= \Yii::$app->urlManager->createUrl(['gastos/index']); ?>"  class="btn btn-danger text-center" style="height: 34px;width: 75%;font-family: FontAwesome;font-size: 12px" id="id_tabprevia"><i class="fa fa-arrow-circle-left" >  </i><b> TERMINAR</b></a>
                

            </div>
        </div>

        <div class="form-group">

        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
