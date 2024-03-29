<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DptoFunciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dpto-funciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dpto')->textInput() ?>

    <?= $form->field($model, 'func')->textInput() ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
