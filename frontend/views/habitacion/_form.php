<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use frontend\models\Ocupacion;

/* @var $this yii\web\View */
/* @var $model frontend\models\Habitacion */
/* @var $form yii\widgets\ActiveForm */
$asset = AppAsset::register($this);
//$baseUrl = Yii::app()->baseUrl; 
//  $cs = Yii::app()->getClientScript();
//  $cs->registerScriptFile($baseUrl.'/js/codes.js');

$ocupacion = Ocupacion::find()->orderBy("id ASC")->all();
?>

<div class="habitacion-form" >
    <div id="respond">
        <?php $form = ActiveForm::begin(); ?>


        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'aria-required' => 'true', 'placeholder' => 'Nombre']) ?>                            
                    </div>
                </div>

            </div>
        </div>



        <div class="row">
            <div style="width: 100%;height: 477px;overflow-y: auto;">



                <?php
                for ($i = 0; $i < count($ocupacion); $i++) {
                    ?>


                    <div id="<?= $ocupacion[$i]->id ?>card_ocupacion" class="col-md-3">
                        <div class="card">
                            <div class="header bg-blue-grey" style="height: 50px">
                                <div class="row">
                                    <div class="col-md-8">
                                        <b>
                                            <?= $ocupacion[$i]->nombre ?>
                                        </b>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="switch">
                                            <label><input value="<?php echo $ocupacion[$i]->id ?>" data-ver="<?= $ocupacion[$i]->id ?>" name="<?= $ocupacion[$i]->id ?>" id="<?= $ocupacion[$i]->id ?>" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div id="<?php echo $ocupacion[$i]->id . "body" ?>" class="body" style="height: 79px">

                                <div>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">monetization_on</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="<?= $ocupacion[$i]->id . "ocupacion_precio" ?>" class="form-control" disabled="true" placeholder="Precio"  name="<?= $ocupacion[$i]->id . "ocupacion_precio" ?>" maxlength="255">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>







                    <?php
                }
                ?>

            </div>
        </div>

        <div class="col-md-2">
            <br style="margin-top: 0.3em">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? ' ADICIONAR' : ' ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success fa fa-plus' : 'btn btn-primary fa fa-edit', 'style' => 'height:33px;width: 80%']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
