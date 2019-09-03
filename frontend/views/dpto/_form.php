<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Funciones;
use frontend\models\DptoFunciones;

$func = Funciones::find()->orderBy('nombre asc')->all();

$nombre = "";
$dptofun = array();
$dptomost = array();
if ($model->nombre != "") {
    $nombre = $model->nombre;
    $dptofun = DptoFunciones::findAll(['dpto' => $model->id]);
    //print_r($dptofun[0]->func);die;
}

/* @var $this yii\web\View */
/* @var $model frontend\models\Dpto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agencia-form">

    <div id="respond">

        <?php $form = ActiveForm::begin(); ?>


        <div class="row">
            <div class="col-md-12">               
                <b>Nombre</b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">
                        <input id="dpto-nombre" class="form-control" name="nombre" maxlength="255" aria-required="true" placeholder="Nombre" type="text" value="<?php echo $nombre ?>">
                    </div>
                </div>    
            </div>
        </div>

        <div class="row">

            <div style="width: 100%;height: 450px;overflow-y: auto;">



                <?php
                if (count($dptofun) == 0) {


                    for ($i = 0; $i < count($func); $i++) {
                        if ($i % 3 == 0 && $i != 0) {
                            ?>
                            <br> <br> 
                        <?php }
                        ?>
                        <div class="col-md-4 text-rigth">

                            <div class="text-rigth">
                                <div class="switch">
                                    <label><input value="<?php echo $func[$i]->id ?>" name="<?php echo $func[$i]->id ?>" id="<?php echo $func[$i]->id ?>" type="checkbox"><span class="lever switch-col-indigo"></span></label> <?php echo " " . $func[$i]->nombre ?>
                                </div>
                            </div>

                        </div>
                        <?php
                    }
                } else {
                    for ($i = 0; $i < count($func); $i++) {
                        if ($i % 3 == 0 && $i != 0) {
                            ?>
                            <br> <br> 
                            <?php
                        }
                        $band = 0;
                        for ($j = 0; $j < count($dptofun); $j++) {
                            if ($func[$i]->id == $dptofun[$j]->func) {
                                $band = 1;
                                ?>
                                <div class="col-md-4 text-rigth">

                                    <div class="text-rigth">
                                        <div class="switch">
                                            <label><input value="<?php echo $func[$i]->id ?>" name="<?php echo $func[$i]->id ?>" id="<?php echo $func[$i]->id ?>" type="checkbox" checked="true"><span class="lever switch-col-indigo"></span></label><?php echo " " . $func[$i]->nombre ?>
                                        </div>
                                    </div>

                                </div>
                                <?php
                            }
                        }
                        if ($band != 1) {
                            ?>
                            <div class="col-md-4 text-rigth">

                                <div class="text-rigth">
                                    <div class="switch">
                                        <label><input value="<?php echo $func[$i]->id ?>" name="<?php echo $func[$i]->id ?>" id="<?php echo $func[$i]->id ?>" type="checkbox"><span class="lever switch-col-indigo"></span></label> <?php echo " " . $func[$i]->nombre ?>
                                    </div>
                                </div>

                            </div>
                            <?php
                        }
                    }
                }
                ?>




            </div>




        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? ' ADICIONAR' : ' ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success fa fa-plus' : 'btn btn-primary fa fa-edit', 'style' => 'height:34px;width: 80%']) ?>
                </div>
            </div>
            <div class="col-md-2" style="margin-top: 1em">
                <a href="<?= \Yii::$app->urlManager->createUrl(['dpto/index']); ?>"  class="btn btn-danger text-center" style="height: 34px;width: 80%" id="id_tabprevia"><i class="fa fa-arrow-circle-left" >  </i> TERMINAR</a>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
