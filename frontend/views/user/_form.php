<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\SignupForm;

/* @var $this yii\web\View */

/* @var $form yii\widgets\ActiveForm */

$mod=new SignupForm();
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    
      <?= $form->field($mod, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($mod, 'apellidos')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($mod, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($mod, 'username')->textInput(['maxlength' => true]) ?>   

    <?= $form->field($mod, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($mod, 'password')->passwordInput(['maxlength' => true]) ?>

 



  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
