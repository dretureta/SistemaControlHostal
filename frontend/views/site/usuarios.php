<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'CREAR USUARIO';
$this->params['breadcrumbs'][] = ['label' => 'USUARIO', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ADICIONAR USUARIO</h3>
    </div>
    <div class="panel-body">
        <div class="site-signup">
            <div class="row">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(['options' => ['onsubmit' => 'return usuario()',]]); ?>

                    <div class="row">
                        <div class="col-md-4">

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

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">face</i>
                                </span>
                                <div class="form-line">                           
                                    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Apellidos']) ?>                            
                                </div>
                            </div>    
                        </div>

                        <div class="col-md-4">

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">account_box</i>
                                </span>
                                <div class="form-line">                           
                                    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Usuario']) ?>                            
                                </div>
                            </div>    
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <div class="form-line">                           
                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Correo']) ?>                            
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-3">

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">brightness_low</i>
                                </span>
                                <div class="form-line">                           
                                    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Contraseña']) ?>                            
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-3">                           
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">brightness_medium</i>
                                </span>
                                <div class="form-line">                           
                                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Confirmar Contraseña']) ?>                            
                                </div>
                            </div>    
                        </div> 
                        <div class="col-md-2">
                            <div class="form-group" style="margin-top: 2em">                                
                                <?= Html::submitButton(' ADICIONAR', ['class' => 'btn btn-primary fa fa-plus', 'name' => 'signup-button', 'style' => 'height:33px;width: 80%']) ?>
                            </div>
                        </div>

                    </div>









                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>