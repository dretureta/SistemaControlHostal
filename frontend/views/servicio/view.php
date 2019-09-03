<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Servicio;

/* @var $this yii\web\View */
/* @var $model frontend\models\Servicio */

$this->title = 'PRIORIDAD SERVICIO';
$this->params['breadcrumbs'][] = ['label' => 'SERVICIO', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'PRIORIDAD';

$model = new Servicio();
$nombre = Yii::$app->request->get('nom');
$prioridad = Yii::$app->request->get('pri');
$ingles = Yii::$app->request->get('ingles');
$frances = Yii::$app->request->get('frances');
?>

<?php
$form = ActiveForm::begin([
            'method' => 'post',
            'id' => '',
            'action' => ['servicio/prioridad']]);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">


        <div class="row">
            <div class="col-md-6">
                <b>Nombre</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre','value'=>$nombre]) ?>                            
                    </div>
                </div>    
            </div>
            <div class="col-md-6">
                <b>Ingles</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'ingles')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Ingles','value'=>$ingles]) ?>                            
                    </div>
                </div>    
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <b>Frances</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'frances')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Frances','value'=>$frances]) ?>                            
                    </div>
                </div>    
            </div>
            <div class="col-md-3">
                <b>Prioridad</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                           
                        <?= $form->field($model, 'prioridad')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Prioridad','value'=>$prioridad]) ?>                            
                    </div>
                </div>    
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'SI' : 'ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'height: 45px;margin-top:3.5em;;width: 100%']) ?>
                </div>
            </div>            
        </div>



    </div>
</div>

<?php ActiveForm::end(); ?>
