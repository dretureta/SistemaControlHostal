<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Agencia;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pasadia */
/* @var $form yii\widgets\ActiveForm */

//if (isset($_GET['id'])) {
//   $mos=  Pasadia::find()->where(['id'=>$_GET['id']])->all();   
//}
?>

<div class="pasadia-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="demo-masked-input">
        <div class="row clearfix">

            <div class="col-md-8">
                <b>Nombre</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">                       
                        <input type="text" id="pasadia-nombre" class="form-control" name="Pasadia[nombre]" placeholder="Nombre" maxlength="255" value="<?php echo $model->nombre ?>">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <b>Fecha</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                        <input type="text" id="fechapasa" class="form-control" name="Pasadia[fecha]" placeholder="Fecha" value="<?php
                        if (isset($_GET['id'])) {
////                            $fe = explode('-', $model->fecha);
////                            $model->fecha = $fe[2] . '-' . $fe[1] . '-' . $fe[0];
                            echo $model->fecha;
                        }
                        ?>">
                    </div>
                </div>
            </div>




        </div>


<br>
        <div class="row">
            <div class="col-md-3" >
                <b>Agencias</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">next_week</i>
                    </span>
                    <div class="form-line">
                        <select id="pasadia-agencia" name="pasadia-agencia" class="form-control show-tick" data-live-search="true">
                            <?php $agen = Agencia::find()->orderBy('nombre asc')->all(); ?>
                            <option >Agencia</option>
                            <?php for ($i = 0; $i < count($agen); $i++) { ?>
                                <option value="<?= $agen[$i]->id ?>"><?= $agen[$i]->nombre ?></option>
                            <?php } ?>


                        </select>



                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <b>Observaciones</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">comment</i>
                    </span>
                    <div class="form-line">
                        <textarea id="obs" rows="1" name="Pasadia[obs]" class="form-control no-resize" placeholder="Observaciones" value="<?php echo $model->obs ?>"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-2" style="margin-top: 1.5em">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? ' ADD SERVICIO' : ' ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success fa fa-plus' : 'btn btn-primary fa fa-edit', 'style' => 'height:33px;width: 80%']) ?>


                </div>

            </div>       
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
