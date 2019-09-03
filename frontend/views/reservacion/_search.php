<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReservacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre_cliente') ?>

    <?= $form->field($model, 'fecha_entrada') ?>

    <?= $form->field($model, 'fecha_salida') ?>

    <?= $form->field($model, 'cant_hab') ?>

    <?php // echo $form->field($model, 'hab') ?>

    <?php // echo $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'agencia') ?>

    <?php // echo $form->field($model, 'ocupacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
