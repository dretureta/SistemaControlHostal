<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Ocupacion;
use frontend\models\Habitacion;

/* @var $this yii\web\View */
/* @var $model frontend\models\OcupacionHab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ocupacion-hab-form">
    <div id="respond">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-4">
                <?php
                $ocu = ArrayHelper::map(Ocupacion::find()->all(), 'id', 'nombre');
                echo $form->field($model, 'ocupacion')->dropDownList(
                        $ocu, [
                    'prompt' => 'Seleccione una ocupación',
                                            'style' => 'height: 50px;margin-top:2em;;width: 100%',
                'aria-required' => 'true'
                        ]
                );
                ?>
            </div>
            <div class="col-md-3">
                <?php
                $hab = ArrayHelper::map(Habitacion::find()->all(), 'id', 'nombre');
                echo $form->field($model, 'hab')->dropDownList(
                $hab, [
                'prompt' => 'Seleccione una hab', 
                'style' => 'height: 50px;margin-top:2em;;width: 100%',
                'aria-required' => 'true'
                ]

                );
                ?>
            </div>
            <div class="col-md-3">
                <p class="comment-form-author">
                    <label>Precio</label>                
                    <?= $form->field($model, 'precio')->textInput(['maxlength' => true, 'class' => 'form-control', 'style' => 'height: 50px;margin-top:-2.5em;;width: 100%', 'aria-required' => 'true']) ?>
                </p>
            </div>
            <div class="col-md-2">
                <br style="margin-top: 0.3em">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'CREAR' : 'ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'height: 45px;margin-top:2em;;width: 100%']) ?>
                </div>

            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
