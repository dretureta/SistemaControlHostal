<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\NotificacionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'notificacion') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
