<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrabFuncionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trab-funciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'trab') ?>

    <?= $form->field($model, 'func') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
