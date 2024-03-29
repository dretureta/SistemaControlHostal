<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Notificaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notificacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
