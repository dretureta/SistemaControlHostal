<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReservacionServiciosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservacion-servicios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reservacion') ?>

    <?= $form->field($model, 'servicio') ?>

    <?= $form->field($model, 'cant') ?>

    <?= $form->field($model, 'precio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
