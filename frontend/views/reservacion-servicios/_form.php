<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReservacionServicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservacion-servicios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reservacion')->textInput() ?>

    <?= $form->field($model, 'servicio')->textInput() ?>

    <?= $form->field($model, 'cant')->textInput() ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
